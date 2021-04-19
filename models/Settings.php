<?php namespace SureSoftware\MailLog\Models;

use Andosto\EventManager\Controllers\EmStats;
use Cms\Classes\Theme;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Model;

class Settings extends Model
{
    public $implement = [
        'System.Behaviors.SettingsModel',
    ];

    public $settingsCode = 'suresoftware_maillog_settings';
    public $settingsFields = 'fields.yaml';
    protected $jsonable = [
        'hidden_templates'
    ];

    public static function getTemplates($relPath) {
        $theme = Theme::getActiveTheme();
        $files = File::allFiles($theme->getPath().$relPath);
        $fileNames = [];
        foreach ($files as $i => $file) {
            $content = explode("\n", $file->getContents());
            $description = "";
            foreach($content as $line) {
                if (strpos($line, 'description') !== false) {
                    $description = trim(explode(' = ', $line)[1]);
                    $description = substr($description, 1, strlen($description)-2);
                    break;
                }
                if ($line == '==') {
                    break;
                }
            }
            $fileNames[$file->getPathname()] = $description ? $description : $file->getFilename();
        }
        
        return $fileNames;
    }
}
