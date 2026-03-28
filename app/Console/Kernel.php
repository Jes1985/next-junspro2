<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * The Artisan commands provided by your application.
   *
   * @var array
   */
  protected $commands = [
    //
  ];

  /**
   * Define the application's command schedule.
   *
   * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    // CRON quotidienne Junspro V2 - Rappels et validations
    $schedule->job(\App\Jobs\ProcessSubscriptionReminders::class)
      ->daily()
      ->at('09:00')
      ->name('junspro-reminders');

    // CRON quotidienne - Reprogrammations abusives
    $schedule->job(\App\Jobs\ProcessAbusiveRebookings::class)
      ->daily()
      ->at('10:00')
      ->name('junspro-abusive-rebookings');

    // CRON hebdomadaire - Calcul score freelance
    $schedule->job(\App\Jobs\CalculateFreelancerScore::class)
      ->weekly()
      ->sundays()
      ->at('02:00')
      ->name('junspro-freelancer-score');

    // CRON quotidienne - Validation commissions affiliées (J+7)
    $schedule->job(\App\Jobs\ValidateAffiliateConversions::class)
      ->daily()
      ->at('03:00')
      ->name('affiliate-validate-conversions')
      ->withoutOverlapping();

    // CRON quotidienne - Validation commissions Pause Souffle (J+30)
    $schedule->job(\App\Jobs\PsValidateConversions::class)
      ->daily()
      ->at('03:30')
      ->name('ps-validate-conversions')
      ->withoutOverlapping();

    // CRON 1er de chaque mois à 08h00 - Bilans mensuels ambassadeurs PS
    $schedule->command('ps:send-monthly-stats')
      ->monthlyOn(1, '08:00')
      ->name('ps-monthly-stats')
      ->withoutOverlapping();
  }

  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }
}
