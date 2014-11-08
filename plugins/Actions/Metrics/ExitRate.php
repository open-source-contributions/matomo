<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\Actions\Metrics;

use Piwik\DataTable\Row;
use Piwik\Piwik;
use Piwik\Plugin\ProcessedMetric;

/**
 * TODO
// % Exit = Number of visits that finished on this page / visits on this page
 */
class ExitRate extends ProcessedMetric
{
    public function getName()
    {
        return 'exit_rate';
    }

    public function getTranslatedName()
    {
        return Piwik::translate('General_ColumnExitRate');
    }

    public function compute(Row $row)
    {
        $exitVisits = $this->getMetric($row, 'exit_nb_visits');
        $visits = $this->getMetric($row, 'nb_visits');

        return Piwik::getQuotientSafe($exitVisits, $visits, $precision = 2);
    }

    public function format($value) // TODO: should create ratio & percent processed metric base types
    {
        return ($value * 100) . '%';
    }

    public function getDependenctMetrics()
    {
        return array('exit_nb_visits', 'nb_visits');
    }
}