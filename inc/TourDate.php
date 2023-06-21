<?php 
class TourDate implements \JsonSerializable {
    private $tourDateID;
    private $tourDateDate;
    private $tourDateVenue;
    private $tourDateCity;
    private $tourDateRegion;
    private $tourDateTicketLink;
    private $tourDateIsSoldOut;

    function __construct($inID, $inDate, $inVenue, $inCity, $inRegion, $inTicketLink, $inIsSoldOut) {
        $this->setTourDateID($inID);
        $this->setTourDateDate($inDate);
        $this->setTourDateVenue($inVenue);
        $this->setTourDateCity($inCity);
        $this->setTourDateRegion($inRegion);
        $this->setTourDateTicketLink($inTicketLink);
        $this->setTourDateIsSoldOut($inIsSoldOut);
    }

    private function setTourDateID($inID) {
        $this->tourDateID = $inID;
    }

    function getTourDateID() {
        return $this->tourDateID;
    }

    function setTourDateDate($inDate) {
        if(is_a($inDate, "DateTime")) {
            $this->tourDateDate = $inDate;
        } else {
            $this->tourDateDate = new DateTime($inDate);
        }
    }

    function getTourDateDate() {
        return $this->tourDateDate;
    }

    function setTourDateVenue($inVenue) {
        $this->tourDateVenue = $inVenue;
    }

    function getTourDateVenue() {
        return $this->tourDateVenue;
    }

    function setTourDateCity($inCity) {
        $this->tourDateCity = $inCity;
    }

    function getTourDateCity() {
        return $this->tourDateCity;
    }

    function setTourDateRegion($inRegion) {
        $this->tourDateRegion = $inRegion;
    }

    function getTourDateRegion() {
        return $this->tourDateRegion;
    }

    function setTourDateTicketLink($inTicketLink) {
        $this->tourDateTicketLink = $inTicketLink;
    }

    function getTourDateTicketLink() {
        return $this->tourDateTicketLink;
    }

    function setTourDateIsSoldOut($inIsSoldOut) {
        $this->tourDateIsSoldOut = $inIsSoldOut;
    }

    function getTourDateIsSoldOut() {
        return $this->tourDateIsSoldOut;
    }

    function jsonSerialize(): mixed {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>