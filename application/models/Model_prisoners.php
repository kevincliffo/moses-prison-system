<?php
class Model_Prisoners extends CI_Model {
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

    function addToDatabase($data)
    {
        $this->db->query("SET sql_mode = '' ");
        $insert = $this->db->insert('prisoners', $data);

        return $insert;
    }

    function addimagetodatabase($data)
    {
        $this->db->query("SET sql_mode = '' ");
        $insert = $this->db->insert('images', $data);
        return $insert;
    }    
    
    public function getallprisoners()

    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('*'); 
        $this->db->order_by('Id', 'ASC');
        $query = $this->db->get('prisoners');

        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getprisonerscount()
    { 
        $this->db->query("SET sql_mode = '' ");
        $sql = 'SELECT COUNT(*) AS US_Count FROM prisoners';
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

    function deleteprisoner($id)
    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('Id', $id);

        $this->db->delete('prisoners');
    }
    
    public function getprisondetailsoverid($id)

    {
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('Id', $id);

        $query = $this->db->get('prisoners');


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
        $this->db->where('PrisonerUUID', $uuid);

        $query = $this->db->get('images');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function getPrisonersSummary()
    {
        $sqlCar = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Car%'";

        $query = $this->db->query($sqlCar);
        $cars = $query->result_array()[0]['Count_ID'];

        $sqlMotorBike = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Motorbike%'";

        $query = $this->db->query($sqlMotorBike);
        $motorbikes = $query->result_array()[0]['Count_ID'];
        
        $sqlBicycle = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Bicycle%'";

        $query = $this->db->query($sqlBicycle);
        $bicycles = $query->result_array()[0]['Count_ID'];
        
        $sqlBus = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Bus%'";

        $query = $this->db->query($sqlBus);
        $buses = $query->result_array()[0]['Count_ID'];
        
        $sqlTruck = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Truck%'";

        $query = $this->db->query($sqlTruck);
        $trucks = $query->result_array()[0]['Count_ID'];
        
        $sqlCart = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Cart%'";

        $query = $this->db->query($sqlCart);
        $carts = $query->result_array()[0]['Count_ID'];
        
        $sqlPerson = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Person%'";

        $query = $this->db->query($sqlPerson);
        $persons = $query->result_array()[0]['Count_ID'];
        
        $sqlTuktuk = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerType LIKE '%Tuktuk%'";

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

    public function getPrisonersForCurrentYearPerMonth($year)
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
            $sql = "SELECT COUNT(Id) AS Count_ID FROM prisoners WHERE PrisonerDate LIKE '%".$stringYearMonth."%'";

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

    public function getPrisonersOverFilter($data)
    {

        $sql = "SELECT * FROM prisoners WHERE Prison ='".$data['Prison']."' ORDER BY Id ASC";


        $query = $this->db->query($sql);
        $prisoners = $query->result_array();


        return $prisoners;

    }
}
