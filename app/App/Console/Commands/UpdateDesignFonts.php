<?php

namespace DDD\App\Console\Commands;

use Illuminate\Console\Command;

use DDD\Domain\Designs\Design;

class UpdateDesignFonts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'designs:update-fonts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the structures of fonts to include weights in each font object';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $designs = Design::all();

        foreach ($designs as $design) {
            $variables = $design->getRawOriginal('variables');

            if (!is_null($variables)) {

                // Update font objects
                if (is_array($design->variables['font_primary'])) {
                    $primary = [
                        'source' => 'upload',
                        'name' => $design->variables['font_primary']['name'],
                        'url' => $design->variables['font_primary']['url'],
                        'weight' => $design->variables['font_primary_weight'],
                    ];
                } else {
                    $primary = [
                        'source' => 'google-font',
                        'name' => $design->variables['font_primary'],
                        'url' => null,
                        'weight' => $design->variables['font_primary_weight'],
                    ];
                }

                if (is_array($design->variables['font_secondary'])) {
                    $secondary = [
                        'source' => 'upload',
                        'name' => $design->variables['font_secondary']['name'],
                        'url' => $design->variables['font_secondary']['url'],
                        'weight' => $design->variables['font_secondary_weight'],
                    ];
                } else {
                    $secondary = [
                        'source' => 'google-font',
                        'name' => $design->variables['font_secondary'],
                        'url' => null,
                        'weight' => $design->variables['font_secondary_weight'],
                    ];
                }

                // Update the design
                $design->update(['variables' =>
                    array_merge($design->variables, [
                        'font_primary' => $primary,
                        'font_secondary' => $secondary,
                    ])
                ]);
            }
        }
    }
}
