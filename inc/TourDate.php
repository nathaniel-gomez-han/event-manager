<?php 
class TourDate implements \JsonSerializable {
    private $id;
    private $showStartDateTime;
    private $venue;
    private $city;
    private $region;
    private $ticketLink;
    private $isSoldOut;

    function __construct($inID, $inShowStartDateTime, $inVenue, $inCity, $inRegion, $inTicketLink, $inIsSoldOut) {
        $this->setID($inID);
        $this->setShowStartDateTime($inShowStartDateTime);
        $this->setVenue($inVenue);
        $this->setCity($inCity);
        $this->setRegion($inRegion);
        $this->setTicketLink($inTicketLink);
        $this->setIsSoldOut($inIsSoldOut);
    }

    private function setID($inID) {
        $this->id = $inID;
    }

    function getID() {
        return $this->id;
    }

    function setShowStartDateTime($inShowStartDateTime) {
        if(is_a($inShowStartDateTime, "DateTime")) {
            $this->showStartDateTime = $inShowStartDateTime;
        } else {
            $this->showStartDateTime = new DateTime($inShowStartDateTime);
        }
    }

    function getShowStartDateTime() {
        return $this->showStartDateTime;
    }

    function setVenue($inVenue) {
        $this->venue = $inVenue;
    }

    function getVenue() {
        return $this->venue;
    }

    function setCity($inCity) {
        $this->city = $inCity;
    }

    function getCity() {
        return $this->city;
    }

    function setRegion($inRegion) {
        $this->region = $inRegion;
    }

    function getRegion() {
        return $this->region;
    }

    function setTicketLink($inTicketLink) {
        $this->ticketLink = $inTicketLink;
    }

    function getTicketLink() {
        return $this->ticketLink;
    }

    function setIsSoldOut($inIsSoldOut) {
        $this->isSoldOut = $inIsSoldOut;
    }

    function getIsSoldOut() {
        return $this->isSoldOut;
    }

    function jsonSerialize(): mixed {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>