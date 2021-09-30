<?php
    class TokenSlip
    {
        private $meterNumber;

        public function setMeterNumber($meterNumber)
        {
            $this->TokenSlip = $meterNumber;
        }

        public function getMeterNumber()
        {
            return $this->meterNumber;
        }
        
        private $customerName;

        public function setCustomerName($customerName)
        {
            $this->customerName = $customerName;
        }

        public function getCustomerName()
        {
            return $this->customerName;
        }

        private $newDebt;

        public function setNewDebt($newDebt)
        {
            $this->newDebt = $newDebt;
        }

        public function getNewDebt()
        {
            $this->newDebt;
        }
        
        private $purchaseQuantity;

        public function setPurchaseQuantity($purchaseQuantity)
        {
            $this->purchaseQuantity = $purchaseQuantity;
        }

        public function getPurchaseQuantity()
        {
            return $this->purchaseQuantity;
        }
        
        
        private $VAT;

        public function setVAT($VAT)
        {
            $this->VAT = $VAT;
        }

        public function getVAT()
        {
            return $this->VAT;
        }
        
        private $totalPaid;

        public function setTotalPaid($totalPaid)
        {
            $this->totalPaid = $totalPaid;
        }

        public function getTotalPaid()
        {
            return $this->totalPaid;
        }
        
        
        private $token;

        public function setToken($token)
        {
            $this->token = $token;
        }

        public function getToken()
        {
            return $this->token;
        }
        
        private $datePosted;

        public function setDatePosted($datePosted)
        {
            $this->datePosted = $datePosted;
        }

        public function getDatePosted()
        {
            return $this->datePosted;
        }
    }


    class Token
    {
        // Config
        private $endpoint = "http://41.87.7.90:9997/api/Tokens";
    

        public function __construct()
        {
        }




        public function displayTokens($meter, $startDate, $endDate)
        {
            if ($startDate=="") {
                $startDate='null';
            }
       
            if ($endDate=="") {
                $endDate='null';
            }
       
       
            $username='michaelphandera';
            $password='Cathybanda4';
       
            $context = stream_context_create(
                array(
                'http'=>array(
                    'header'=>"Authorization:".base64_encode($username.':'.$password)
                )
            )
            );

        
            try {
                $jsonResponse =file_get_contents($this->endpoint.'?meterNumber='.$meter.'&startDate='.$startDate.'&endDate='.$endDate, false, $context);
       
                $data =  json_decode($jsonResponse);
              
                if ($data->statusCode==0) {
                    if (count($data->TokenSlip)) {
                        echo "<table  class='table table-striped table-bordered col-3'>
                        <tr><th>Meter</th><th>Customer</th><th>From</th><th>To</th></tr>";
                        $firstRow = $data->TokenSlip[0];
                        echo "<tr><td>$firstRow->meterNumber</td>";
                        echo "<td>$firstRow->customerName</td>";
                        echo "<td>" . date('d-m-Y', strtotime($startDate)) . "</td>";
                        echo "<td>" . date('d-m-Y', strtotime($endDate)) . "</td>";
                        echo "</tr></table>";

                        echo "
                        <div class='table-responsive'>
                          <table  id='table' style='text-align:center;' width='100%'class='table table-striped table-bordered border border-primary'> 
                            <thead >
                                <tr class='bg-primary text-white text-uppercase'>
                                     <th style='border:1px solid green;width:20%'>Token</th>
                                     <th>Amount Paid</th>
                                     
                                     <th>Units</th>
                                     
                                     <th>Date</th>
                                  </tr> 
                            </thead>
                            <tbody>";
                        // Cycle through the array
                        foreach ($data->TokenSlip as $idx => $TokenSlip) {
                            $d = explode("/", $TokenSlip->datePosted);
                            $newDate = $d[2] . "/" . $d[1] . "/" . $d[0];

                          
                            // Output a row
                            echo "<tr>";
                            echo "<td style='border:1px solid green;' width='15%'>$TokenSlip->token</td>";
                            echo "<td>$TokenSlip->totalPaid</td>";
                            
                            echo "<td>$TokenSlip->purchaseQuantity</td>";
                           
                            echo "<td><span id='hide'>$newDate</span>$TokenSlip->datePosted</td>";
                            echo "</tr>";
                        }
                        // Close the table
                        echo "</tbody></table></div>";
                    } else {
                        echo '<table class="table" width="20%" ><tr><td style="text-align:center"><h4>No Tokens</h4></td></tr></table>';
                    }
                } else {
                    echo '<table class="table" width="20%" ><tr ><td style="text-align:center"><h4>Internal Server error</h4></td></tr></table>';
                }
            } catch (Exception $e) {
                echo '<table class="table" width="20%" ><tr><td style="text-align:center"><h4>Unknown Service Error</h4></td></tr></table>';
            }
        }
    }

   $token = new Token();
