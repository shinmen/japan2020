<?php 

namespace App\Infrastructure\Flight;

use App\Domain\Travel\DTO\Airport;

class CodeToAirportMapper
{
    const UNKNOWN_AIRPORT_NAME = 'inconnu';
    const UNKNOWN_CITY = 'ville inconnue';
    const UNKNOWN_COUNTRY = 'pays inconnu';

    private $airportFilePath;

    public function __construct(string $airportFilePath)
    {
        $this->airportFilePath = $airportFilePath;
    }

    public function mapAirportFromCode(string $code): Airport
    {
        $jsonAirports = file_get_contents($this->airportFilePath);
        $airports = json_decode($jsonAirports, true);

        if (!array_key_exists($code, $airports)) {
            return new Airport(
                $code, 
                self::UNKNOWN_AIRPORT_NAME, 
                self::UNKNOWN_CITY, 
                self::UNKNOWN_COUNTRY
            );
        }

        $airport = $airports[$code];
        
        return new Airport(
            $code, 
            $airport['airport'], 
            $airport['city'], 
            $airport['country']
        );
    }
}
