<?php


// Main data including multiple parameters
$users = [
    [
        "id" => 1,
        "unitname" => "Madurai STP",
        "category"  =>"50KLD",
        "city"      =>"Madurai",
        "parameter" => [
            "PH" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "BOD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "COD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "TSS" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
        ]
    ],
    [
        "id" => 2,
        "unitname" => "Chennai STP",
        "category"  =>"40KLD",
        "city"      =>"Chennai",
        "parameter" => [
            "PH" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "BOD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "COD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "TSS" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
        ]
        ],
        [
            "id" => 3,
            "unitname" => "Coimbatore STP",
            "category"  =>"40KLD",
            "city"      =>"coimbatore",
            "parameter" => [
                "PH" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "BOD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "COD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "TSS" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            ]
            ],
            [
                "id" => 4,
                "unitname" => "Trichy STP",
                "category"  =>"40KLD",
                "city"      =>"Trichy",
                "parameter" => [
                    "PH" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "BOD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "COD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "TSS" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
                ]
                ],
                [
                    "id" => 5,
                    "unitname" => "Vellore STP",
                    "category"  =>"40KLD",
                    "city"      =>"Vellore",
                    "parameter" => [
                        "PH" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "BOD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "COD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "TSS" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
                    ]
                    ],
                    [
                        "id" => 6,
                        "unitname" => "Tanjore STP",
                        "category"  =>"40KLD",
                        "city"      =>"Tanjore",
                        "parameter" => [
                           "PH" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "BOD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "COD" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
            "TSS" => [
                "2019-05-01" => "30",
                "2019-05-02" => "40",
                "2019-05-03" => "50"
            ],
                        ]
                    ]
];

// Insert main data and parameter values
foreach ($users as $user) {
    // Insert main data
    $id = $user['id'];
    $unitname = $conn->real_escape_string($user['unitname']);
    $category = $conn->real_escape_string($user['category']);
    $city = $conn->real_escape_string($user['city']);

    $sql = "INSERT INTO stp_data (id, unitname, category, city) VALUES ('$id', '$unitname', '$category', '$city') ON DUPLICATE KEY UPDATE unitname='$unitname', category='$category', city='$city'";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted/updated successfully for ID: $id<br>";
    } else {
        echo "Error inserting record for ID: $id - " . $conn->error . "<br>";
    }

    // Insert parameter values
    foreach ($user['parameter'] as $param_type => $dates) {
        foreach ($dates as $date => $value) {
            $value = $conn->real_escape_string($value);
            $sql = "INSERT INTO stp_parameters (id, date, parameter_type, value) VALUES ('$id', '$date', '$param_type', '$value') ON DUPLICATE KEY UPDATE value='$value'";

            if ($conn->query($sql) === TRUE) {
                echo "$param_type value inserted/updated successfully for ID: $id on Date: $date<br>";
            } else {
                echo "Error inserting $param_type value for ID: $id on Date: $date - " . $conn->error . "<br>";
            }
        }
    }
}

// Close connection
$conn->close();
?>
