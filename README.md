# Plugin in development not used to production

## Install
Add to composer repositories
```json
...
"repositories": [
    ...
    {
        "type":"vcs",
        "url": "https://github.com/LeMaX10/preload.git"
    }
    ...
],
...
"require": {
  ...
  "lemax10/preload": "dev-master"
  ...
},
...
```

## Setting
add opcache preload config to php.ini or opcache.ini

```bash
opcache.preload={pathToProject}/plugins/lemax10/preload/preload.php
```

### Preloading setting
* vendor/laravel
* vendor/october
* modules

### Ignore setting
* .blade.php',
* Laravel\Telescope',
* Laravel\Tinker',
* Laravel\Sail',
* Illuminate\Queue',
* Illuminate\Contracts\Queue',
* Illuminate\View',
* Illuminate\Contracts\View',
* Illuminate\Foundation\Console',
* Illuminate\Notification',
* Illuminate\Contracts\Notifications',
* Illuminate\Bus',
* Illuminate\Session',
* Illuminate\Contracts\Session',
* Illuminate\Console',
* Illuminate\Testing',
* Illuminate\Http\Testing',
* Illuminate\Support\Testing',
* Illuminate\Cookie',
* Illuminate\Contracts\Cookie',
* Illuminate\Broadcasting',
* Illuminate\Contracts\Broadcasting',
* Illuminate\Mail',
* Illuminate\Contracts\Mail',
* Illuminate\Filesystem\Cache',
* Illuminate\Foundation\Testing',
* october/rain/src/Assetic',
* october/rain/tests',
* system/views',
* system/models',
* system/traits',
* system/routes',
* system/database',
* system/classes/ModelBehavior',
* backend/classes/ControllerBehavior',
* backend/classes/WidgetBase',
* backend/database',
* backend/helpers/exception/DecompileException',
* backend/models',
* backend/routes',
* backend/traits',
* backend/views',
* backend/widgets/table/DataSourceBase',
* backend/behaviors/importexportcontroller/TranscodeFilter',
* cms/classes/CmsObject',
* cms/contracts/CmsObject',
* cms/models',
* cms/database',
* cms/routes',
* cms/views',
* system/behaviors/SettingsModel',
* system/classes/MediaLibrary',
* system/twig/Loader'
