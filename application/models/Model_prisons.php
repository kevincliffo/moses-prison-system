<?php
class Model_Prisons extends CI_Model {
    public function getallcounties()
    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('*'); 
        $this->db->order_by('Id', 'ASC');
        $query = $this->db->get('counties');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getallcrimes()
    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('*'); 
        $this->db->order_by('Id', 'ASC');
        $query = $this->db->get('crimes');
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function addToDatabase($data)
    {
        $this->db->query("SET sql_mode = '' ");
        $insert = $this->db->insert('prisons', $data);

        return $insert;
    }

    function addCrimeToDatabase($data)
    {
        $this->db->query("SET sql_mode = '' ");
        $insert = $this->db->insert('crimes', $data);

        return $insert;
    }

    function addimagetodatabase($data)
    {
        $this->db->query("SET sql_mode = '' ");
        $insert = $this->db->insert('images', $data);
        return $insert;
    }    
    
    public function getallprisons()

    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('*'); 
        $this->db->order_by('Id', 'ASC');
        $query = $this->db->get('prisons');

        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getprisonscount()
    { 
        $this->db->query("SET sql_mode = '' ");
        $sql = 'SELECT COUNT(*) AS US_Count FROM prisons';
        $result = $this->db->query($sql);

        if($result->num_rows() > 0)
        {
            $count = (int)$result->result()[0]->US_Count ;
        }
        else
        {
            $count = 0;
        }

        return $count;
    }

    function deleteprison($id)
    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('Id', $id);

        $this->db->delete('prisons');
    }
    
    public function getprisondetailsoverid($id)

    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('Id', $id);

        $query = $this->db->get('prisons');


        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function getimagesoveruuid($uuid)
    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('PrisonUUID', $uuid);

        $query = $this->db->get('images');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function getPrisonsSummary()
    {
        $sqlCar = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Car%'";

        $query = $this->db->query($sqlCar);
        $cars = $query->result_array()[0]['Count_ID'];

        $sqlMotorBike = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Motorbike%'";

        $query = $this->db->query($sqlMotorBike);
        $motorbikes = $query->result_array()[0]['Count_ID'];
        
        $sqlBicycle = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Bicycle%'";

        $query = $this->db->query($sqlBicycle);
        $bicycles = $query->result_array()[0]['Count_ID'];
        
        $sqlBus = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Bus%'";

        $query = $this->db->query($sqlBus);
        $buses = $query->result_array()[0]['Count_ID'];
        
        $sqlTruck = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Truck%'";

        $query = $this->db->query($sqlTruck);
        $trucks = $query->result_array()[0]['Count_ID'];
        
        $sqlCart = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Cart%'";

        $query = $this->db->query($sqlCart);
        $carts = $query->result_array()[0]['Count_ID'];
        
        $sqlPerson = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Person%'";

        $query = $this->db->query($sqlPerson);
        $persons = $query->result_array()[0]['Count_ID'];
        
        $sqlTuktuk = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonType LIKE '%Tuktuk%'";

        $query = $this->db->query($sqlTuktuk);
        $tuktuks = $query->result_array()[0]['Count_ID'];
        

        $prisonSummary = array(

            'Cars' => $cars,
            'Motorbikes' => $motorbikes,
            'Bicycles' => $bicycles,
            'Buses' => $buses,
            'Trucks' => $trucks,
            'Carts' => $carts,
            'Persons' => $persons,
            'Tuktuks' => $tuktuks,
        );

        return $prisonSummary;

    }

    public function getPrisonsForCurrentYearPerMonth($year)
    {
        $stringYear = strval($year);
        $stringMonth = '';
        $stringYearMonth = '';
        $monthValue = 1;
        $prisonValues = array();


        for ($monthIndex = 0; $monthIndex <= 12; $monthIndex++) {
            $stringMonth = strval($monthValue);

            if((strlen($stringMonth) == 1))
            {
                $stringMonth = "0".$monthValue;
            }
            $stringYearMonth = $stringYear."-".$stringMonth;
            $sql = "SELECT COUNT(Id) AS Count_ID FROM prisons WHERE PrisonDate LIKE '%".$stringYearMonth."%'";

            $query = $this->db->query($sql);
            $value = $query->result_array()[0]['Count_ID'];

            $prisonValues[$monthIndex] = $value;

            $monthValue = $monthValue + 1;
        }

        return array(
            'Jan' =>$prisonValues[0],

            'Feb' =>$prisonValues[1],

            'Mar' =>$prisonValues[2],

            'Apr' =>$prisonValues[3],

            'May' =>$prisonValues[4],

            'Jun' =>$prisonValues[5],

            'Jul' =>$prisonValues[6],

            'Aug' =>$prisonValues[7],

            'Sep' =>$prisonValues[8],

            'Oct' =>$prisonValues[9],

            'Nov' =>$prisonValues[10],

            'Dec' =>$prisonValues[11],

        );
    }

    public function getPrisonsOverFilter($data)
    {

        switch ($data['FilterType']) {
            case 'PrisonType':
                $sql = "SELECT * FROM prisons WHERE PrisonType LIKE '%".$data['PrisonType']."%' ORDER BY Id ASC";

                break;
            
            case 'Monthly':
                $year = date('Y');
                if(strlen($data['Month']) == 1)
                {
                    $data['Month'] = "0".$data['Month'];
                }
                $datePart = strval($year)."-".$data['Month'];

                $sql = "SELECT * FROM prisons WHERE PrisonType LIKE '%".$data['PrisonType']."%' AND PrisonDate LIKE '%".$datePart."%' ORDER BY Id ASC";

                break;
            
            case 'Yearly':
                $sql = "SELECT * FROM prisons WHERE PrisonType LIKE '%".$data['PrisonType']."%' AND PrisonDate LIKE '%".$data['Year']."%' ORDER BY Id ASC";

                break;
            
            case 'County':
                $sql = "SELECT * FROM prisons WHERE County = '".$data['County']."' ORDER BY Id ASC";

                break;

            case 'NumberPlate':
                $sql = "SELECT * FROM prisons INNER JOIN motorvehicles ON motorvehicles.PrisonUUID = prisons.UUID where "

                     . " motorvehicles.NumberPlate = '".$data['NumberPlate']."'";
        }

        $query = $this->db->query($sql);
        $prisons = $query->result_array();


        return $prisons;

    }
}
