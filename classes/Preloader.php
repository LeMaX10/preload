<?php declare(strict_types=1);
$basePath = dirname(__DIR__, 4);
require $basePath .'/vendor/autoload.php';

/**
 * Class Preloader
 * @package LeMaX10\Preload\Classes
 * @author Vladimir Pyankov, rdlrobot@gmail.com
 */
class Preloader
{
    /**
     * @var array
     */
    private array $ignores = [];

    /**
     * @var int
     */
    private static int $count = 0;

    /**
     * @var string[]
     */
    private array $paths;

    /**
     * @var array
     */
    private array $fileMap;

    /**
     * Preloader constructor.
     * @param  string  ...$paths
     */
    public function __construct(string ...$paths)
    {
        $this->paths = $paths;
        $classMap = require __DIR__ . '/../../../../vendor/composer/autoload_classmap.php';
        $this->fileMap = array_flip($classMap);
    }

    /**
     * @param  string  ...$paths
     * @return $this
     */
    public function paths(string ...$paths): self
    {
        $this->paths = array_merge(
            $this->paths,
            $paths
        );

        return $this;
    }

    /**
     * @param  string  ...$names
     * @return $this
     */
    public function ignore(string ...$names): self
    {
        $this->ignores = array_merge(
            $this->ignores,
            $names
        );

        return $this;
    }

    /**
     *
     */
    public function load(): void
    {
        foreach ($this->paths as $path) {
            $this->loadPath(rtrim($path, '/'));
        }

        $count = static::$count;
        echo "[Preloader] Preloaded {$count} classes" . PHP_EOL;
    }

    /**
     * @param  string  $path
     */
    private function loadPath(string $path): void
    {
        $loadMethod = is_dir($path) ? 'loadDir' : 'loadFile';
        $this->{$loadMethod}($path);
    }

    /**
     * @param  string  $path
     */
    private function loadDir(string $path): void
    {
        $dirIterator = new \RecursiveDirectoryIterator($path, $this->getDirIteratorFlags());
        $iterator = new \RecursiveIteratorIterator($dirIterator, \RecursiveIteratorIterator::SELF_FIRST);
        $regexpIterator = new \RegexIterator(
            $iterator,
            '/.+((?<!blade)+\.php$)/i',
            \RecursiveRegexIterator::GET_MATCH
        );
        foreach ($regexpIterator as $filePath => $fileInfo) {
            $this->loadFile($filePath);
        }
    }

    /**
     * @param  string  $path
     */
    private function loadFile(string $path): void
    {
        $class = $this->fileMap[$path] ?? $path;
        if ($this->shouldIgnore($class)) {
            return;
        }

        require_once ($path);

        static::$count++;
        echo "[Preloader] Preloaded `{$class}`" . PHP_EOL;
    }

    /**
     * @param  string|null  $name
     * @return bool
     */
    private function shouldIgnore(?string $name): bool
    {
        if ($name === null) {
            return true;
        }

        foreach ($this->ignores as $ignore) {
            $ignore = str_replace('\\', '/', $ignore);
            if (strpos($name, $ignore) > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    private function getDirIteratorFlags(): int
    {
        return \FilesystemIterator::KEY_AS_PATHNAME
            | \FilesystemIterator::CURRENT_AS_FILEINFO
            | \FilesystemIterator::SKIP_DOTS;
    }
}
