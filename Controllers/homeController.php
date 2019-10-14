<?php
require(ROOT . 'Models/Onboarding.php');

class homeController extends Controller
{
    function index()
    {
        $this->render("index");
    }

    function show()
    {
        $this->layout = "charts";
        $this->render("show");
    }

//get by weekly onboarding percentage
    function getData(){
            $onboarding= new Onboarding();
            $results = $onboarding->findAll();
            $count = count($results);
            $firstDate = $results[0]['created_at'];
            $lastDate = $results[$count-1]['created_at'];
            $date1=date_create($firstDate);
            $date2=date_create($lastDate);
            $diff=date_diff($date1,$date2);
            //total number of lines for graph
            $no_of_weeks = ceil($diff->format("%R%a")/7);
            
            $data = array();            
            $i = 1;
            $loop_first_date = $firstDate;

            while($i <= $no_of_weeks){
                $week_name = "Week".$i; //name line graphs                
                $loop_last_date = date('Y-m-d H:i:s', strtotime($loop_first_date . ' +7 day'));
                $data[$i-1]['name'] = $week_name;
                $data[$i-1]['data'] = array();
                //onboarding steps
                $ob0 = 0;
                $ob20 = 0;
                $ob40 = 0;
                $ob50 = 0;
                $ob70 = 0;
                $ob90 = 0;
                $ob99 = 0;
                $ob100 = 0;
                $week_count = 0;

                foreach ($results as $key => $value) {
                    if($value['created_at'] <= $loop_last_date){
                        $week_count++;
                        switch ($value['onboarding_perentage']) {
                            case '20':
                                $ob20++;
                                break;
                            case '40':
                                $ob40++;
                                break;
                            case '50':
                                $ob50++;
                                break;
                            case '70':
                                $ob70++;
                                break;
                            case '90':
                                $ob90++;
                                break;
                            case '99':
                                $ob99++;
                                break;
                            case '100':
                                $ob100++;
                                break;

                        }

                    }
                
                }
                //get percentages
                $ob0 = 100;
                $ob20 = round(($ob20/$week_count)*100, 2);
                $ob40 = round(($ob40/$week_count)*100, 2);
                $ob50 = round(($ob50/$week_count)*100, 2);
                $ob70 = round(($ob70/$week_count)*100, 2);
                $ob90 = round(($ob90/$week_count)*100, 2);
                $ob99 = round(($ob99/$week_count)*100, 2);
                $ob100 = round(($ob100/$week_count)*100, 2);
                $data[$i-1]['data'] = array(array(0,$ob0),array(20,$ob20),array(40,$ob40),array(50,$ob50),array(70,$ob70),array(90,$ob90),array(99,$ob99),array(100,$ob100));
                $loop_first_date = $loop_last_date;
                $i++;

            }
            echo json_encode($data);
    }
    
}
?>