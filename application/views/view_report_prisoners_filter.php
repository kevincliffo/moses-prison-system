                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Prisoner Filter Report</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>
                        
                        <div>
                            <center><h3>Report Filters</h3></center>
                            <input type="hidden" name="filterType" id="filterType" value="AccidentType">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <select id="prison" name="prison" class="form-control">
                                                <option selected disabled>Select Prison</option>
                                                <?php 
                                                    foreach($prisons as $prison)
                                                    {
                                                        echo '<option value='.$prison['Name']. '>'.$prison['Name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <select id="crime" name="crime" class="form-control">
                                                <option selected disabled>Select Crime</option>
                                                <?php 
                                                    foreach($crimes as $crime)
                                                    {
                                                        echo '<option value='.$crime['CrimeName']. '>'.$crime['CrimeName'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $sentenceDate = array('class' => 'form-control',
                                                    'id'=>'sentenceDate',
                                                    'name'=>'sentenceDate',
                                                    'type' => 'date',
                                                    'title' => 'Sentence Date',
                                                );
                                                echo form_input($sentenceDate);                       
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php 
                                                $releaseDate = array('class' => 'form-control',
                                                    'id'=>'releaseDate',
                                                    'name'=>'releaseDate',
                                                    'type' => 'date',
                                                    'title' => 'Release Date',
                                                );

                                                echo form_input($releaseDate);   
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>                            
                        </div>
                        <div id="printing">
                            <center><h3>Report Details</h3></center>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php
                                        $template = array(
                                            'table_open'=> '<table border="0" id="dataTableReports" cellpadding="0" class="table table-bordered">',                                        
                                            'id'=>'dataTableReports',
                                            'width'=>'100%',
                                            'cellspacing'=>'0'
                                        );
                            
                                        $counter = 1;
                                        $this->table->set_heading('Id', 'First Name', 'Last Name', 'ID Number', 'Crime', 'Crime County', 'Details', 'Prison', 'Sentence Date', 'Release Date', 'Remove Prisoner');
                                        foreach ($prisoners as $prisoner)
                                        {
                                            $this->table->add_row($counter, $prisoner['FirstName'], $prisoner['LastName'], $prisoner['IDNumber'], $prisoner['Crime'], $prisoner['CrimeCounty'], $prisoner['Details'], $prisoner['Prison'], $prisoner['SentenceDate'], $prisoner['ReleaseDate'], anchor('prisoners/removeprisoner/'.$prisoner['Id'], 'Remove'));
                                            $counter = $counter + 1;
                                        }
                                        $this->table->add_row('<b>Id</b>', '<b>First Name</b>', '<b>Last Name</b>', '<b>ID Number</b>', '<b>Crime</b>', '<b>Crime County</b>', '<b>Details</b>', '<b>Prison</b>', '<b>Sentence Date</b>', '<b>Release Date</b>', '<b>Remove Prisoner</b>');
                                        $this->table->set_template($template);
                                        echo $this->table->generate();
                                    ?>
                                </div>
                            </div>
                        </div>                                                  
                        <?php
                            $btn = array('class' => 'btn btn-primary btn-block',
                                        'value' => 'Generate Report',
                                        'name' => 'generateReportData',
                                        'id' => 'generateReportData',
                                        'onclick' => "generateReport()",
                                        'type' => 'button');
                            echo form_submit($btn);

                            $btn = array('class' => 'btn btn-primary btn-block',
                                        'value' => 'Print',
                                        'name' => 'print',
                                        'onclick' => "printReport('printing')",
                                        'type' => 'button');
                            echo form_submit($btn);
                        ?>
                    </div>
                    <!-- /.container-fluid -->                           