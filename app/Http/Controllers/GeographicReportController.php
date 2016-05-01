<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeographicReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function makeOutput($data)
    {
        $array = array();
        $mapData = $this::getMapArray();
        foreach ($data as $key => $value) {
            foreach ($mapData as $mapKey => $mapValue) {
                if (strcmp($mapValue->name,$value->country) == 0)
                {
                    if ($value->type=="adsense")
                    {
                        $mapValue->color = "#00a65a";
                        $mapValue->name = "Adsense: ".$mapValue->name;
                    }else{
                        $mapValue->color = "#39cccc";
                        $mapValue->name = "LSM: ".$mapValue->name;
                    }
                    $mapValue->value = $value->impressions;
                    if ($value->impressions > 0)
                    {
                        array_push($array, $mapValue);
                    }
                    break;
                }
            }
        }
        return json_encode($array);
    }
    private function getMapArray()
    {

        $data = '[{
                "code": "AF",
                "name": "Afghanistan",
                
                "color": "#eea638"
            }, {
                "code": "AL",
                "name": "Albania",
                
                "color": "#d8854f"
            }, {
                "code": "DZ",
                "name": "Algeria",
                
                "color": "#de4c4f"
            }, {
                "code": "AO",
                "name": "Angola",
                "color": "#de4c4f"
            }, {
                "code": "AR",
                "name": "Argentina",
                
                "color": "#86a965"
            }, {
                "code": "AM",
                "name": "Armenia",
                
                "color": "#d8854f"
            }, {
                "code": "AU",
                "name": "Australia",
                
                "color": "#8aabb0"
            }, {
                "code": "AT",
                "name": "Austria",
                
                "color": "#d8854f"
            }, {
                "code": "AZ",
                "name": "Azerbaijan",
                
                "color": "#d8854f"
            }, {
                "code": "BH",
                "name": "Bahrain",
                
                "color": "#eea638"
            }, {
                "code": "BD",
                "name": "Bangladesh",
                
                "color": "#eea638"
            }, {
                "code": "BY",
                "name": "Belarus",
                
                "color": "#d8854f"
            }, {
                "code": "BE",
                "name": "Belgium",
                
                "color": "#d8854f"
            }, {
                "code": "BJ",
                "name": "Benin",
                
                "color": "#de4c4f"
            }, {
                "code": "BT",
                "name": "Bhutan",
                
                "color": "#eea638"
            }, {
                "code": "BO",
                "name": "Bolivia",
                
                "color": "#86a965"
            }, {
                "code": "BA",
                "name": "Bosnia and Herzegovina",
                
                "color": "#d8854f"
            }, {
                "code": "BW",
                "name": "Botswana",
                
                "color": "#de4c4f"
            }, {
                "code": "BR",
                "name": "Brazil",
                
                "color": "#86a965"
            }, {
                "code": "BN",
                "name": "Brunei",
                
                "color": "#eea638"
            }, {
                "code": "BG",
                "name": "Bulgaria",
                
                "color": "#d8854f"
            }, {
                "code": "BF",
                "name": "Burkina Faso",
                
                "color": "#de4c4f"
            }, {
                "code": "BI",
                "name": "Burundi",
                
                "color": "#de4c4f"
            }, {
                "code": "KH",
                "name": "Cambodia",
                
                "color": "#eea638"
            }, {
                "code": "CM",
                "name": "Cameroon",
                
                "color": "#de4c4f"
            }, {
                "code": "CA",
                "name": "Canada",
                
                "color": "#a7a737"
            }, {
                "code": "CV",
                "name": "Cape Verde",
                
                "color": "#de4c4f"
            }, {
                "code": "CF",
                "name": "Central African Rep.",
                
                "color": "#de4c4f"
            }, {
                "code": "TD",
                "name": "Chad",
                
                "color": "#de4c4f"
            }, {
                "code": "CL",
                "name": "Chile",
                
                "color": "#86a965"
            }, {
                "code": "CN",
                "name": "China",
                
                "color": "#eea638"
            }, {
                "code": "CO",
                "name": "Colombia",
                
                "color": "#86a965"
            }, {
                "code": "KM",
                "name": "Comoros",
                
                "color": "#de4c4f"
            }, {
                "code": "CD",
                "name": "Congo, Dem. Rep.",
                
                "color": "#de4c4f"
            }, {
                "code": "CG",
                "name": "Congo, Rep.",
                
                "color": "#de4c4f"
            }, {
                "code": "CR",
                "name": "Costa Rica",
                
                "color": "#a7a737"
            }, {
                "code": "CI",
                "name": "Cote d\'Ivoire",
                
                "color": "#de4c4f"
            }, {
                "code": "HR",
                "name": "Croatia",
                
                "color": "#d8854f"
            }, {
                "code": "CU",
                "name": "Cuba",
                
                "color": "#a7a737"
            }, {
                "code": "CY",
                "name": "Cyprus",
                
                "color": "#d8854f"
            }, {
                "code": "CZ",
                "name": "Czech Rep.",
                
                "color": "#d8854f"
            }, {
                "code": "DK",
                "name": "Denmark",
                
                "color": "#d8854f"
            }, {
                "code": "DJ",
                "name": "Djibouti",
                
                "color": "#de4c4f"
            }, {
                "code": "DO",
                "name": "Dominican Rep.",
                
                "color": "#a7a737"
            }, {
                "code": "EC",
                "name": "Ecuador",
                
                "color": "#86a965"
            }, {
                "code": "EG",
                "name": "Egypt",
                
                "color": "#de4c4f"
            }, {
                "code": "SV",
                "name": "El Salvador",
                
                "color": "#a7a737"
            }, {
                "code": "GQ",
                "name": "Equatorial Guinea",
                
                "color": "#de4c4f"
            }, {
                "code": "ER",
                "name": "Eritrea",
                
                "color": "#de4c4f"
            }, {
                "code": "EE",
                "name": "Estonia",
                
                "color": "#d8854f"
            }, {
                "code": "ET",
                "name": "Ethiopia",
                
                "color": "#de4c4f"
            }, {
                "code": "FJ",
                "name": "Fiji",
                
                "color": "#8aabb0"
            }, {
                "code": "FI",
                "name": "Finland",
                
                "color": "#d8854f"
            }, {
                "code": "FR",
                "name": "France",
                
                "color": "#d8854f"
            }, {
                "code": "GA",
                "name": "Gabon",
                
                "color": "#de4c4f"
            }, {
                "code": "GM",
                "name": "Gambia",
                
                "color": "#de4c4f"
            }, {
                "code": "GE",
                "name": "Georgia",
                
                "color": "#d8854f"
            }, {
                "code": "DE",
                "name": "Germany",
                
                "color": "#d8854f"
            }, {
                "code": "GH",
                "name": "Ghana",
                
                "color": "#de4c4f"
            }, {
                "code": "GR",
                "name": "Greece",
                
                "color": "#d8854f"
            }, {
                "code": "GT",
                "name": "Guatemala",
                
                "color": "#a7a737"
            }, {
                "code": "GN",
                "name": "Guinea",
                
                "color": "#de4c4f"
            }, {
                "code": "GW",
                "name": "Guinea-Bissau",
                
                "color": "#de4c4f"
            }, {
                "code": "GY",
                "name": "Guyana",
                
                "color": "#86a965"
            }, {
                "code": "HT",
                "name": "Haiti",
                
                "color": "#a7a737"
            }, {
                "code": "HN",
                "name": "Honduras",
                
                "color": "#a7a737"
            }, {
                "code": "HK",
                "name": "Hong Kong",
                
                "color": "#eea638"
            }, {
                "code": "HU",
                "name": "Hungary",
                
                "color": "#d8854f"
            }, {
                "code": "IS",
                "name": "Iceland",
                
                "color": "#d8854f"
            }, {
                "code": "IN",
                "name": "India",
                
                "color": "#eea638"
            }, {
                "code": "ID",
                "name": "Indonesia",
                
                "color": "#eea638"
            }, {
                "code": "IR",
                "name": "Iran",
                
                "color": "#eea638"
            }, {
                "code": "IQ",
                "name": "Iraq",
                
                "color": "#eea638"
            }, {
                "code": "IE",
                "name": "Ireland",
                
                "color": "#d8854f"
            }, {
                "code": "IL",
                "name": "Israel",
                
                "color": "#eea638"
            }, {
                "code": "IT",
                "name": "Italy",
                
                "color": "#d8854f"
            }, {
                "code": "JM",
                "name": "Jamaica",
                
                "color": "#a7a737"
            }, {
                "code": "JP",
                "name": "Japan",
                
                "color": "#eea638"
            }, {
                "code": "JO",
                "name": "Jordan",
                
                "color": "#eea638"
            }, {
                "code": "KZ",
                "name": "Kazakhstan",
                
                "color": "#eea638"
            }, {
                "code": "KE",
                "name": "Kenya",
                
                "color": "#de4c4f"
            }, {
                "code": "KR",
                "name": "Korea, Dem. Rep.",
                
                "color": "#eea638"
            }, {
                "code": "KP",
                "name": "Korea, Rep.",
                
                "color": "#eea638"
            }, {
                "code": "KW",
                "name": "Kuwait",
                
                "color": "#eea638"
            }, {
                "code": "KG",
                "name": "Kyrgyzstan",
                
                "color": "#eea638"
            }, {
                "code": "LA",
                "name": "Laos",
                
                "color": "#eea638"
            }, {
                "code": "LV",
                "name": "Latvia",
                
                "color": "#d8854f"
            }, {
                "code": "LB",
                "name": "Lebanon",
                
                "color": "#eea638"
            }, {
                "code": "LS",
                "name": "Lesotho",
                
                "color": "#de4c4f"
            }, {
                "code": "LR",
                "name": "Liberia",
                
                "color": "#de4c4f"
            }, {
                "code": "LY",
                "name": "Libya",
                
                "color": "#de4c4f"
            }, {
                "code": "LT",
                "name": "Lithuania",
                
                "color": "#d8854f"
            }, {
                "code": "LU",
                "name": "Luxembourg",
                
                "color": "#d8854f"
            }, {
                "code": "MK",
                "name": "Macedonia, FYR",
                
                "color": "#d8854f"
            }, {
                "code": "MG",
                "name": "Madagascar",
                
                "color": "#de4c4f"
            }, {
                "code": "MW",
                "name": "Malawi",
                
                "color": "#de4c4f"
            }, {
                "code": "MY",
                "name": "Malaysia",
                
                "color": "#eea638"
            }, {
                "code": "ML",
                "name": "Mali",
                
                "color": "#de4c4f"
            }, {
                "code": "MR",
                "name": "Mauritania",
                
                "color": "#de4c4f"
            }, {
                "code": "MU",
                "name": "Mauritius",
                
                "color": "#de4c4f"
            }, {
                "code": "MX",
                "name": "Mexico",
                
                "color": "#a7a737"
            }, {
                "code": "MD",
                "name": "Moldova",
                
                "color": "#d8854f"
            }, {
                "code": "MN",
                "name": "Mongolia",
                
                "color": "#eea638"
            }, {
                "code": "ME",
                "name": "Montenegro",
                
                "color": "#d8854f"
            }, {
                "code": "MA",
                "name": "Morocco",
                
                "color": "#de4c4f"
            }, {
                "code": "MZ",
                "name": "Mozambique",
                
                "color": "#de4c4f"
            }, {
                "code": "MM",
                "name": "Myanmar",
                
                "color": "#eea638"
            }, {
                "code": "NA",
                "name": "Namibia",
                
                "color": "#de4c4f"
            }, {
                "code": "NP",
                "name": "Nepal",
                
                "color": "#eea638"
            }, {
                "code": "NL",
                "name": "Netherlands",
                
                "color": "#d8854f"
            }, {
                "code": "NZ",
                "name": "New Zealand",
                
                "color": "#8aabb0"
            }, {
                "code": "NI",
                "name": "Nicaragua",
                
                "color": "#a7a737"
            }, {
                "code": "NE",
                "name": "Niger",
                
                "color": "#de4c4f"
            }, {
                "code": "NG",
                "name": "Nigeria",
                
                "color": "#de4c4f"
            }, {
                "code": "NO",
                "name": "Norway",
                
                "color": "#d8854f"
            }, {
                "code": "OM",
                "name": "Oman",
                
                "color": "#eea638"
            }, {
                "code": "PK",
                "name": "Pakistan",
                
                "color": "#eea638"
            }, {
                "code": "PA",
                "name": "Panama",
                
                "color": "#a7a737"
            }, {
                "code": "PG",
                "name": "Papua New Guinea",
                
                "color": "#8aabb0"
            }, {
                "code": "PY",
                "name": "Paraguay",
                
                "color": "#86a965"
            }, {
                "code": "PE",
                "name": "Peru",
                
                "color": "#86a965"
            }, {
                "code": "PH",
                "name": "Philippines",
                
                "color": "#eea638"
            }, {
                "code": "PL",
                "name": "Poland",
                
                "color": "#d8854f"
            }, {
                "code": "PT",
                "name": "Portugal",
                
                "color": "#d8854f"
            }, {
                "code": "PR",
                "name": "Puerto Rico",
                
                "color": "#a7a737"
            }, {
                "code": "QA",
                "name": "Qatar",
                
                "color": "#eea638"
            }, {
                "code": "RO",
                "name": "Romania",
                
                "color": "#d8854f"
            }, {
                "code": "RU",
                "name": "Russia",
                
                "color": "#d8854f"
            }, {
                "code": "RW",
                "name": "Rwanda",
                
                "color": "#de4c4f"
            }, {
                "code": "SA",
                "name": "Saudi Arabia",
                
                "color": "#eea638"
            }, {
                "code": "SN",
                "name": "Senegal",
                
                "color": "#de4c4f"
            }, {
                "code": "RS",
                "name": "Serbia",
                
                "color": "#d8854f"
            }, {
                "code": "SL",
                "name": "Sierra Leone",
                
                "color": "#de4c4f"
            }, {
                "code": "SG",
                "name": "Singapore",
                
                "color": "#eea638"
            }, {
                "code": "SK",
                "name": "Slovak Republic",
                
                "color": "#d8854f"
            }, {
                "code": "SI",
                "name": "Slovenia",
                
                "color": "#d8854f"
            }, {
                "code": "SB",
                "name": "Solomon Islands",
                
                "color": "#8aabb0"
            }, {
                "code": "SO",
                "name": "Somalia",
                
                "color": "#de4c4f"
            }, {
                "code": "ZA",
                "name": "South Africa",
                
                "color": "#de4c4f"
            }, {
                "code": "ES",
                "name": "Spain",
                
                "color": "#d8854f"
            }, {
                "code": "LK",
                "name": "Sri Lanka",
                
                "color": "#eea638"
            }, {
                "code": "SD",
                "name": "Sudan",
                
                "color": "#de4c4f"
            }, {
                "code": "SR",
                "name": "Suriname",
                
                "color": "#86a965"
            }, {
                "code": "SZ",
                "name": "Swaziland",
                
                "color": "#de4c4f"
            }, {
                "code": "SE",
                "name": "Sweden",
                
                "color": "#d8854f"
            }, {
                "code": "CH",
                "name": "Switzerland",
                
                "color": "#d8854f"
            }, {
                "code": "SY",
                "name": "Syria",
                
                "color": "#eea638"
            }, {
                "code": "TW",
                "name": "Taiwan",
                
                "color": "#eea638"
            }, {
                "code": "TJ",
                "name": "Tajikistan",
                
                "color": "#eea638"
            }, {
                "code": "TZ",
                "name": "Tanzania",
                
                "color": "#de4c4f"
            }, {
                "code": "TH",
                "name": "Thailand",
                
                "color": "#eea638"
            }, {
                "code": "TG",
                "name": "Togo",
                
                "color": "#de4c4f"
            }, {
                "code": "TT",
                "name": "Trinidad and Tobago",
                
                "color": "#a7a737"
            }, {
                "code": "TN",
                "name": "Tunisia",
                
                "color": "#de4c4f"
            }, {
                "code": "TR",
                "name": "Turkey",
                
                "color": "#d8854f"
            }, {
                "code": "TM",
                "name": "Turkmenistan",
                
                "color": "#eea638"
            }, {
                "code": "UG",
                "name": "Uganda",
                
                "color": "#de4c4f"
            }, {
                "code": "UA",
                "name": "Ukraine",
                
                "color": "#d8854f"
            }, {
                "code": "AE",
                "name": "United Arab Emirates",
                
                "color": "#eea638"
            }, {
                "code": "GB",
                "name": "Great Britain",
                
                "color": "#d8854f"
            },
            {
                "code": "GB1",
                "name": "United Kingdom",
                
                "color": "#d8854f"
            }, {
                "code": "US",
                "name": "United States",
                
                "color": "#a7a737"
            }, {
                "code": "UY",
                "name": "Uruguay",
                
                "color": "#86a965"
            }, {
                "code": "UZ",
                "name": "Uzbekistan",
                
                "color": "#eea638"
            }, {
                "code": "VE",
                "name": "Venezuela",
                
                "color": "#86a965"
            }, {
                "code": "PS",
                "name": "West Bank and Gaza",
                
                "color": "#eea638"
            }, {
                "code": "VN",
                "name": "Vietnam",
                
                "color": "#eea638"
            }, {
                "code": "YE",
                "name": "Yemen, Rep.",
                
                "color": "#eea638"
            }, {
                "code": "ZM",
                "name": "Zambia",
                
                "color": "#de4c4f"
            }, {
                "code": "ZW",
                "name": "Zimbabwe",
                
                "color": "#de4c4f"
            }]';
        return json_decode($data);            

    }
}
