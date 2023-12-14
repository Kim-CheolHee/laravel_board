<?php

namespace App\Console\Commands;

use App\Models\Theme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ModuleSymlink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:symlink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 기본 symlink
        $defaultLinks = ['css', 'js', 'mix-manifest.json'];

        // 기기 타입
        $deviceTypes = array_keys(config('citroorder.device.type'));

        // 사용하고 있는 테마들
        $themes = Theme::whereHas('devices')->get();

        // 기기 모듈
        foreach ($deviceTypes as $deviceType) {

            // 포스일 경우 kitchenPad 추가
            if( $deviceType == 'pos' ) {
                $defaultLinks[] = 'kitchenPad';
            }

            // 사용하고 있는 모듈인지 판단
            if (isEnableModules($deviceType)) {
                // 모듈명
                $moduleName = config("citroorder.module_name.{$deviceType}");

                // 해당 기기 유형이 사용하고 있는 테마 slug들
                $useSlugs = $themes->where('device_type', $deviceType)
                    ->pluck('slug')->unique()->toArray();

                // 기기 폴더 없는 경우 기기 폴더 생성
                $path = "modules/{$deviceType}";
                $publicPath = public_path($path);
                File::isDirectory($publicPath) || File::makeDirectory($publicPath, 0775, true);

                // 기본 symlink
                foreach ($defaultLinks as $link) {
                    $this->symlinkModule($moduleName, $path, $link);
                }

                // 테마 기본 세팅
                $themePath = "modules/{$deviceType}/themes";
                $publicThemePath = public_path($themePath);
                File::isDirectory($publicThemePath) || File::makeDirectory($publicThemePath, 0775, true);

                // 링크가 있지만 사용하고 있지 않은 테마 지우기
                $issetThemes = $this->getFolder($publicThemePath);
                // 지울 테마 폴더
                $removeThemes = array_diff($issetThemes, $useSlugs);
                foreach ($removeThemes as $slug) {
                    $this->rmdirAll("{$publicThemePath}/{$slug}");
                }

                // 사용하고 있지만 심볼릭 링크가 없는 테마 연결하기
                // 테마 symlink
                foreach ($useSlugs as $slug) {
                    $this->symlinkModule($moduleName, $themePath, $slug, 'themes/');
                }
            }
        }

        // 기기가 아닌 모듈
        $defaultModules = ['messaging', 'webview'];
        foreach ($defaultModules as $module) {
            // 사용하고 있는 모듈인지 판단
            if (isEnableModules($module)) {
                // 모듈명
                $moduleName = config("citroorder.module_name.{$module}");

                // 심볼릭 링크 연결
                $path = "modules/{$module}";
                $publicPath = public_path($path);
                File::isDirectory($publicPath) || File::makeDirectory($publicPath, 0775, true);
                // 기본 symlink
                foreach ($defaultLinks as $link) {
                    $this->symlinkModule($moduleName, $path, $link);
                }

                // 웹뷰 테마
                if ($module == 'webview') {
                    // 테마 기본 세팅
                    $themePath = "modules/{$module}/themes";
                    $publicThemePath = public_path($themePath);
                    File::isDirectory($publicThemePath) || File::makeDirectory($publicThemePath, 0775, true);

                    // 사용중인 테마
                    $useSlugs = [env('WEBVIEW_THEME')];

                    // 링크가 있지만 사용하고 있지 않은 테마 지우기
                    $issetThemes = $this->getFolder($publicThemePath);
                    // 지울 테마 폴더
                    $removeThemes = array_diff($issetThemes, $useSlugs);
                    foreach ($removeThemes as $slug) {
                        $this->rmdirAll("{$publicThemePath}/{$slug}");
                    }

                    // 사용하고 있지만 심볼릭 링크가 없는 테마 연결하기
                    // 테마 symlink
                    foreach ($useSlugs as $slug) {
                        $this->symlinkModule($moduleName, $themePath, $slug, 'themes/');
                    }
                }
            }
        }

        // 컨트롤러 사용법
        // Artisan::call('module:symlink');
        return 0;
    }

    /**
     * moduleName: 모듈 이름
     * link: 링크를 걸 곳
     * target: 링크를 걸 대상 (파일 또는 폴더)
     * moduleFolder: 모듈 Public 하위 폴더 (themes)
     */
    private function symlinkModule($moduleName, $link, $target, $moduleFolder = '')
    {

        $basePath = in_array($target, ['theme1', 'theme_1024', 'basic', 'basic_vertical', 'css', 'js', 'mix-manifest.json', 'kitchenPad'])
                        ? base_path("Modules/{$moduleName}/Public/{$moduleFolder}{$target}")
                        : base_path("Modules/{$moduleName}/Resources/assets/themes/{$target}/public");

        if (!isEnableModules($moduleName)) {
            return ;
        }
        if (! $this->existTarget($basePath)) {
            return ;
        }

        // 링크 존재 여부
        $isDir = $this->existTarget(public_path("{$link}/{$target}"));
        // 심볼릭 링크 여부
        $isLink = is_link(public_path("{$link}/{$target}"));

        // 심볼릭 링크가 아닌 경우 (링크가 존재하지 않는 경우 포함)
        if (!$isLink) {
            // 링크가 존재하는 경우 삭제
            if ($isDir) {
                $this->rmdirAll(public_path("{$link}/{$target}"));
            }
            // 심볼릭 링크 연결
            symlink($basePath, public_path("$link/$target"));
        }
    }

    /**
     * 폴더 내부 파일까지 전부 삭제
     */
    private function rmdirAll($dir)
    {
        if (!file_exists($dir)) {
          return ;
        }

        // 심볼릭 링크 여부
        $isLink = is_link($dir);
        if ($isLink) { unlink($dir); }
        else {
            $dhandle = opendir($dir);
            if ($dhandle) {
                while (false !== ($fname = readdir($dhandle))) {
                    if (is_dir( "{$dir}/{$fname}" )) {
                        if (($fname != '.') && ($fname != '..')) {
                            $this->rmdirAll("$dir/$fname");
                        }
                    }
                    else {
                        unlink("{$dir}/{$fname}");
                    }
                }
                closedir($dhandle);
            }
            rmdir($dir);
        }
    }

    /**
     * path에서 폴더 명 가져오기
     */
    private function getFolder($path)
    {
        $folderArr = [];

        foreach (glob("{$path}/*", GLOB_ONLYDIR) as $folder) {
            $folderArr[] = basename($folder);
        }

        return $folderArr;
    }

    /**
     * 링크 또는 파일 존재 여부
     */
    private function existTarget($target)
    {
        // 폴더 존재 여부
        $isDir = is_dir($target);
        // 파일 존재 여부
        $isFile = file_exists($target);

        return $isDir || $isFile;
    }
}
