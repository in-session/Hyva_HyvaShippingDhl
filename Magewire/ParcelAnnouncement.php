<?php

declare(strict_types=1);

namespace Hyva\HyvaShippingDhl\Magewire;

use Magewirephp\Magewire\Component;
use Dhl\Paket\Model\ShippingSettings\ShippingOption\Codes;
use Netresearch\ShippingCore\Api\Data\ShippingSettings\ShippingOption\Selection\SelectionInterface;

class ParcelAnnouncement extends ShippingOptions
{
    /**
     * @var bool
     */
    public bool $parcelAnnouncement = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        /** @var $quoteSelection SelectionInterface */
        $quoteSelections = $this->loadFromDb(Codes::SERVICE_OPTION_PARCEL_ANNOUNCEMENT);

        if ($quoteSelections) {
            if (isset($quoteSelections['enabled'])) {
                $this->parcelAnnouncement = (bool) $quoteSelections['enabled']->getInputValue();
            }
        }
    }

    /**
     * Updates the parcel announcement state.
     * 
     * @param bool $value
     * @return mixed
     */
    public function updatedParcelAnnouncement(bool $value): mixed
    {
        return $this->persistFieldUpdate(
            'enabled', 
            $value, 
            Codes::SERVICE_OPTION_PARCEL_ANNOUNCEMENT
        );
    }
}
