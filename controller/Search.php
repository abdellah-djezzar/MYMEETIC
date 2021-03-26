<?php
require_once "../models/Users.php";

class Search extends Users
{
    public $array;
    private $where;
    private $whereSex;
    private $whereSexParam;
    private $whereAge;
    private $whereAgeParam;
    private $whereCity;
    private $whereCityParam;
    private $request;
    private $whereCity2;
    private $whereCity2Param;
    private $whereCity3;
    private $whereCity3Param;


    public function getUsersFromParam()
    {
        $select = "users.name, users.firstname, users.birthdate, users.sexe, users.pseudo, users.city";
        $from = "users";
        if (!empty($_GET)) {
            $this->checkSex();
            $this->checkAge();
            $this->checkCity();
            $this->checkCity2();
            $this->checkCity3();
            $this->initializeArrayForRequest();
            $this->getUsersRequest();
            $userFromParam = Users::getUsersByParam($this->request, $this->where);
            if (!empty($userFromParam)) {
                $this->writeCarouselRender($userFromParam);
            } else {
                $this->writeRenderIfNoResult();
            }
        } else {
            $this->getUsersFromMyCity($select, $from);
        }
    }

    private function checkComplexRequest()
    {
        if (($this->whereSex != null && $this->whereSexParam != null) && ($this->whereCity != null
                && $this->whereCityParam != null) && ($this->whereAge != null && $this->whereAgeParam != null)) {
            if (count($this->whereAge) > 1) {
                $this->request .= $this->whereSex . "'" . $this->whereSexParam . "'" . " AND " . $this->whereCity
                    . "'" . $this->whereCityParam . "'" . " AND " . $this->whereAge[0] . "'" .
                    $this->whereAgeParam[0] . "'" . " AND " . $this->whereAge[1] . "'" . $this->whereAgeParam[1] . "'";
            } else {
                $this->request .= $this->whereSex . "'" . $this->whereSexParam . "'" . " AND " . $this->whereCity
                    . "'" . $this->whereCityParam . "'" . " AND " . $this->whereAge . "'" . $this->whereAgeParam . "'";
            }
        } elseif (($this->whereCity != null && $this->whereCityParam != null)
            && ($this->whereAge != null && $this->whereAgeParam != null)) {
            if (count($this->whereAge) > 1) {
                $this->request .= $this->whereCity . "'" . $this->whereCityParam . "'" . " AND " . $this->whereAge[0]
                    . "'" . $this->whereAgeParam[0] . "'" . " AND " . $this->whereAge[1] . "'"
                    . $this->whereAgeParam[1] . "'";
            } else {
                $this->request .= $this->whereCity . "'" . $this->whereCityParam . "'" . " AND " . $this->whereAge
                    . "'" . $this->whereAgeParam . "'";
            }
        }
    }

    private function checkComplexRequest2($countRequestForSecure1)
    {
        if (strlen($this->request) === $countRequestForSecure1) {
            if ($this->whereAge != null && $this->whereAgeParam != null
                && $this->whereSex != null && $this->whereSexParam != null) {
                if (count($this->whereAge) > 1) {
                    $this->request .= $this->whereSex . "'" . $this->whereSexParam . "'" . " AND "
                        . $this->whereAge[0] . "'" . $this->whereAgeParam[0] . "'" . " AND " . $this->whereAge[1]
                        . "'" . $this->whereAgeParam[1] . "'";
                } else {
                    $this->request .= $this->whereSex . "'" . $this->whereSexParam . "'" . " AND "
                        . $this->whereAge . "'" . $this->whereAgeParam . "'";
                }
            } elseif (($this->whereCity != null && $this->whereCityParam != null)
                && ($this->whereSex != null && $this->whereSexParam != null)) {
                $this->request .= $this->whereSex . "'" . $this->whereSexParam . "'" . " AND " . $this->whereCity
                    . "'" . $this->whereCityParam . "'";
            } elseif ($this->whereCity != null && $this->whereCityParam != null) {
                $this->request .= $this->whereCity . "'" . $this->whereCityParam . "'";
            } elseif ($this->whereAge != null && $this->whereAgeParam != null) {
                $this->request .= $this->whereAge . "'" . $this->whereAgeParam . "'";
            } elseif ($this->whereSex != null && $this->whereSexParam != null) {
                $this->request .= $this->whereSex . "'" . $this->whereSexParam . "'";
            }
        }
    }

    public function getUsersRequest()
    {
        $this->request = "SELECT users.name, users.firstname, users.birthdate, users.sexe, users.pseudo, users.city
                    FROM users WHERE ";
        $countRequestForSecure1 = strlen($this->request);
        $this->request .= $this->checkComplexRequest();
        $countRequestForSecure2 = strlen($this->request);
        $this->request .= $this->checkComplexRequest2($countRequestForSecure1);
        $this->checkRequestForCities();
    }

    private function checkRequestForCities()
    {
        if ($this->whereCity2 != null && $this->whereCity2Param != null) {
            $this->request .= $this->whereCity2 . "'" . $this->whereCity2Param . "";
        } elseif ($this->whereCity3 != null && $this->whereCity3Param != null) {
            $this->request .= $this->whereCity3 . "'" . $this->whereCity3Param . "";
        }
    }

    private function initializeArrayForRequest()
    {
        $this->where[0] = $this->whereSex;
        $this->where[1] = $this->whereSexParam;
        $this->where[2] = $this->whereAge;
        $this->where[3] = $this->whereAgeParam;
        $this->where[4] = $this->whereCity;
        $this->where[5] = $this->whereCityParam;
        $this->where[6] = $this->whereCity2;
        $this->where[7] = $this->whereCity2Param;
        $this->where[8] = $this->whereCity3;
        $this->where[9] = $this->whereCity3Param;
    }
    private function checkSex()
    {
        if (isset($_GET['sexe'])) {
            $this->whereSex = "users.sexe = ";
            if ($_GET['sexe'] === "H") {
                $this->whereSexParam = "H";
            } elseif ($_GET['sexe'] === "F") {
                $this->whereSexParam = "F";
            } elseif ($_GET['sexe'] === "A") {
                $this->whereSexParam = "A";
            } else {
                $this->whereSex = "";
                $this->whereSexParam = "";
            }
        }
    }

    private function checkAge()
    {
        if (isset($_GET['birthdate'])) {
            if ($_GET['birthdate'] === "25-") {
                $this->whereAge = "users.birthdate > ";
                $this->whereAgeParam = self::ageToDate("25");
            } elseif ($_GET['birthdate'] === "35-") {
                $this->whereAge[0] = "users.birthdate < ";
                $this->whereAgeParam[0] = self::ageToDate("25");
                $this->whereAge[1] = "users.birthdate > ";
                $this->whereAgeParam[1] = self::ageToDate("35");
            } elseif ($_GET['birthdate'] === "45-") {
                $this->whereAge[0] = "users.birthdate < ";
                $this->whereAgeParam[0] = self::ageToDate("35");
                $this->whereAge[1] = "users.birthdate > ";
                $this->whereAgeParam[1] = self::ageToDate("45");
            } elseif ($_GET['birthdate'] === "45+") {
                $this->whereAge = "users.birthdate < ";
                $this->whereAgeParam = self::ageToDate("45");
            } else {
                $this->whereAge = "";
                $this->whereAgeParam = "";
            }
        }
    }

    private function checkCity()
    {
        if (isset($_GET['city'])) {
            if (!empty($_GET['city2']) || !empty($_GET['city3'])) {
                $this->whereCity = " ((users.city = ";
            } else {
                $this->whereCity = " users.city = ";
            }
            if ($_GET['city'] === "Paris") {
                $this->whereCityParam = "Paris";
            } elseif ($_GET['city'] === "Lyon") {
                $this->whereCityParam = "Lyon";
            } elseif ($_GET['city'] === "Marseille") {
                $this->whereCityParam = "Marseille";
            } else {
                $this->whereCity = "";
                $this->whereCityParam = "";
            }
        }
    }

    private function checkCity2()
    {
        if (isset($_GET['city2'])) {
            $this->whereCity2 = ") OR (users.city = ";
            if (empty($_GET['city3'])) {
                if ($_GET['city2'] === "Paris") {
                    $this->whereCity2Param = "Paris'))";
                } elseif ($_GET['city2'] === "Lyon") {
                    $this->whereCity2Param = "Lyon'))";
                } elseif ($_GET['city2'] === "Marseille") {
                    $this->whereCity2Param = "Marseille'))";
                } else {
                    $this->whereCity2 = "";
                    $this->whereCity2Param = "";
                }
            } else {
                if ($_GET['city2'] === "Paris") {
                    $this->whereCity2Param = "Paris";
                } elseif ($_GET['city2'] === "Lyon") {
                    $this->whereCity2Param = "Lyon";
                } elseif ($_GET['city2'] === "Marseille") {
                    $this->whereCity2Param = "Marseille";
                } else {
                    $this->whereCity2 = "";
                    $this->whereCity2Param = "";
                }
            }
        }
    }

    private function checkCity3()
    {
        if (isset($_GET['city3'])) {
            $this->whereCity3 = ") OR (users.city = ";
            if (!empty($_GET['city2'])) {
                if ($_GET['city3'] === "Paris") {
                    $this->whereCity3Param = "Paris'))";
                } elseif ($_GET['city3'] === "Lyon") {
                    $this->whereCity3Param = "Lyon'))";
                } elseif ($_GET['city3'] === "Marseille") {
                    $this->whereCity3Param = "Marseille'))";
                } else {
                    $this->whereCity3 = "";
                    $this->whereCity3Param = "";
                }
            } else {
                if ($_GET['city3'] === "Paris") {
                    $this->whereCity3Param = "Paris";
                } elseif ($_GET['city3'] === "Lyon") {
                    $this->whereCity3Param = "Lyon";
                } elseif ($_GET['city3'] === "Marseille") {
                    $this->whereCity3Param = "Marseille";
                } else {
                    $this->whereCity3 = "";
                    $this->whereCity3Param = "";
                }
            }
        }
    }

    public static function ageToDate($age)
    {
        $currentTime = Date("Y-m-d");
        $newDate = DateTime::createFromFormat("Y-m-d", $currentTime);
        $interval = "P" . $age . "Y";
        try {
            $dateInterval = new DateInterval($interval);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $newDate->sub($dateInterval);
        $newDate = $newDate['date'];
        $newDate->format('Y-m-d');
        $birthDate = DateTime::createFromFormat("Y-m-d", $newDate);
        return $birthDate;
    }

    public function testInput($data)
    {
        $data = trim($data);
        $data= stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function getUsersFromMyCity($select, $from)
    {
        $where = "users.id";
        $whereCity = "users.city";
        $id = $_SESSION['id'];
        $user = Users::getUser($select, $from, $where, $id);
        $userFromCity = Users::getUsersByCity($select, $from, $whereCity, $user['city']);
        if (!empty($userFromCity)) {
            $this->writeMyCityRender($userFromCity);
        } else {
            $this->writeRenderIfNoResult();
        }
        return $userFromCity;
    }

    public function writeMyCityRender($userFromCity)
    {
        echo '<ul id="ul_carousel"> ';
        for ($i = 0; $i < count($userFromCity); $i++) {
            echo '<li class="carousel_slides"><div class="search_carousel">
                <img class="img-thumbnail search_carousel_img" src="webroot/images/profiles.png" alt="carousel_image">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-12">
                        <p class="data_profile">Nom : ' . $userFromCity[$i]["name"] . '</p></div>
                    <div class="col-12">
                        <p class="data_profile">Prénom : ' . $userFromCity[$i]["firstname"] . '</p></div>
                    <div class="col-12">
                        <p class="data_profile">Date de naissance : ' . $userFromCity[$i]["birthdate"] . '</p></div>
                </div>
                <div class="col-sm-6">
                    <div class="col-12">
                        <p class="data_profile">Sexe : ' . $userFromCity[$i]["sexe"] . '</p></div>
                    <div class="col-12">
                        <p class="data_profile">Pseudo : ' . $userFromCity[$i]["pseudo"] . '</p>
                    </div>
                    <div class="col-12">
                        <p class="data_profile">Ville : ' . $userFromCity[$i]["city"] . '</p></div>
                </div>
            </div></div></li>';
        }
        $this->createArrows();
        echo '</ul>';
    }

    public function createArrows()
    {
        echo'<li class="carousel_arrows"><div class="carousel_arrows">
            <img id="carousel_left_arrow" src="webroot/images/left_arrow.png" alt="left_arrow_logo">
            <img id="carousel_right_arrow" src="webroot/images/right_arrow.png" alt="right_arrow_logo">
        </div></li>';
    }

    public function writeCarouselRender($userFromParam)
    {
        echo '<ul id="ul_carousel">';
        for ($i = 0; $i < count($userFromParam); $i++) {
            echo '<li class="carousel_slides"><div class="search_carousel">
            <img class="img-thumbnail search_carousel_img" src="webroot/images/profiles.png" alt="carousel_image">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-12"><p class="data_profile">
                    Nom : ' . $userFromParam[$i]["name"] . '</p></div>
                    <div class="col-12"><p class="data_profile">
                        Prénom : ' . $userFromParam[$i]["firstname"] . '</p></div>
                    <div class="col-12"><p class="data_profile">
                        Date de naissance : ' . $userFromParam[$i]["birthdate"] . '</p></div>
                </div>
                <div class="col-sm-6">
                    <div class="col-12"><p class="data_profile">
                    Sexe : ' . $userFromParam[$i]["sexe"] . '</p></div>
                    <div class="col-12"><p class="data_profile">
                        Pseudo : ' . $userFromParam[$i]["pseudo"] . '</p></div>
                    <div class="col-12"><p class="data_profile">
                    Ville : ' . $userFromParam[$i]["city"] . '</p></div>
                </div>
            </div>
        </div></li>';
        }
        $this->createArrows();
        echo '</ul>';
    }

    public function writeRenderIfNoResult()
    {
        echo '<div class="container search_carousel">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-12">
                        <p id="no_result_search" class="data_profile">Aucun résultat n\'a été trouvé !</p>
                    </div>
                </div>
            </div>
        </div>';
    }
}
