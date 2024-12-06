<?php
/**
 * Class Interval
 *
 * PHP version 7
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
namespace Visionet\AbandonedCart\Model\Config\Source\Carts;

/**
 * Class Interval
 *
 * @category Visionet
 * @package  Visionet_AbandonedCart
 * @author   Visionet <magento@Visionet-technologies.com>
 * @license  https://www.Visionet-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.Visionet-technologies.com
 */
class Interval implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Available times.
     *
     * @var array
     */
    public $times
        = [
            1,
            2,
            3,
            4,
            5,
            6,
            12,
            24,
            36,
            48,
            60,
            72,
            84,
            96,
            108,
            120,
            240,
        ];

    /**
     * Send to campain options hours.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $result = $row = [];
        $i = 0;
        foreach ($this->times as $one) {
            if ($i == 0) {
                $row = [
                    'value' => $one,
                    'label' => $one . __(' Hour'),
                ];
            } else {
                $row = [
                    'value' => $one,
                    'label' => $one . __(' Hours'),
                ];
            }
            $result[] = $row;
            ++$i;
        }

        return $result;
    }
}
