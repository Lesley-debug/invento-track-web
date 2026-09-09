<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        Sitemap::create()
            ->add(Url::create('/')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(1.0))
            ->add(Url::create('/register')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/login')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/privacy-policy')
                ->setPriority(0.3)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/terms')
                ->setPriority(0.3)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/cookies')
                ->setPriority(0.3)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/for/pharmacies')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/supermarkets')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/hospitals')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/nigeria')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/ghana')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/kenya')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/cameroon')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            // Global country pages
            ->add(Url::create('/for/uk')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/usa')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/canada')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/india')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/france')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/australia')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/uae')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            // Industry pages
            ->add(Url::create('/for/restaurants')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/warehouses')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/for/clinics')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
