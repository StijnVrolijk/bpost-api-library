<?php
namespace TijsVerkoyen\Bpost\Bpost\Order\Box\Customsinfo;

use TijsVerkoyen\Bpost\Exception;

/**
 * bPost CustomsInfo class
 *
 * @author    Tijs Verkoyen <php-bpost@verkoyen.eu>
 * @version   3.0.0
 * @copyright Copyright (c), Tijs Verkoyen. All rights reserved.
 * @license   BSD License
 */
class CustomsInfo
{
    /**
     * @var int
     */
    private $parcelValue;

    /**
     * @var string
     */
    private $contentDescription;

    /**
     * @var string
     */
    private $shipmentType;

    /**
     * @var string
     */
    private $parcelReturnInstructions;

    /**
     * @var bool
     */
    private $privateAddress;

    /**
     * @param string $contentDescription
     */
    public function setContentDescription($contentDescription)
    {
        $length = 50;
        if (mb_strlen($contentDescription) > $length) {
            throw new Exception(sprintf('Invalid length, maximum is %1$s.', $length));
        }

        $this->contentDescription = $contentDescription;
    }

    /**
     * @return string
     */
    public function getContentDescription()
    {
        return $this->contentDescription;
    }

    /**
     * @param string $parcelReturnInstructions
     */
    public function setParcelReturnInstructions($parcelReturnInstructions)
    {
        $parcelReturnInstructions = strtoupper($parcelReturnInstructions);

        if (!in_array($parcelReturnInstructions, self::getPossibleParcelReturnInstructionValues())) {
            throw new Exception(
                sprintf(
                    'Invalid value, possible values are: %1$s.',
                    implode(', ', self::getPossibleParcelReturnInstructionValues())
                )
            );
        }

        $this->parcelReturnInstructions = $parcelReturnInstructions;
    }

    /**
     * @return string
     */
    public function getParcelReturnInstructions()
    {
        return $this->parcelReturnInstructions;
    }

    /**
     * @return array
     */
    public static function getPossibleParcelReturnInstructionValues()
    {
        return array(
            'RTA',
            'RTS',
            'ABANDONED',
        );
    }

    /**
     * @param int $parcelValue
     */
    public function setParcelValue($parcelValue)
    {
        $this->parcelValue = $parcelValue;
    }

    /**
     * @return int
     */
    public function getParcelValue()
    {
        return $this->parcelValue;
    }

    /**
     * @param boolean $privateAddress
     */
    public function setPrivateAddress($privateAddress)
    {
        $this->privateAddress = $privateAddress;
    }

    /**
     * @return boolean
     */
    public function getPrivateAddress()
    {
        return $this->privateAddress;
    }

    /**
     * @param string $shipmentType
     */
    public function setShipmentType($shipmentType)
    {
        $shipmentType = strtoupper($shipmentType);

        if (!in_array($shipmentType, self::getPossibleShipmentTypeValues())) {
            throw new Exception(
                sprintf(
                    'Invalid value, possible values are: %1$s.',
                    implode(', ', self::getPossibleShipmentTypeValues())
                )
            );
        }

        $this->shipmentType = $shipmentType;
    }

    /**
     * @return string
     */
    public function getShipmentType()
    {
        return $this->shipmentType;
    }

    /**
     * @return array
     */
    public static function getPossibleShipmentTypeValues()
    {
        return array(
            'SAMPLE',
            'GIFT',
            'DOCUMENTS',
            'OTHER',
        );
    }

    /**
     * Return the object as an array for usage in the XML
     *
     * @return array
     */
    public function toXMLArray()
    {
        $data = array();
        if ($this->getParcelValue() !== null) {
            $data['parcelValue'] = $this->getParcelValue();
        }
        if ($this->getContentDescription() !== null) {
            $data['contentDescription'] = $this->getContentDescription();
        }
        if ($this->getShipmentType() !== null) {
            $data['shipmentType'] = $this->getShipmentType();
        }
        if ($this->getPossibleParcelReturnInstructionValues() !== null) {
            $data['parcelReturnInstructions'] = $this->getParcelReturnInstructions();
        }
        if ($this->getPrivateAddress() !== null) {
            $data['privateAddress'] = $this->getPrivateAddress();
        }

        return $data;
    }

}