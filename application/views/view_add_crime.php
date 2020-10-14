                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Add Prison</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>

                        <div>
                            <?php 
                                echo form_open('prisons/addcrimetodb');
                            ?>
                            <center><h3>Crime Name</h3></center>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <?php
                                                $crimeName = array('class' => 'form-control',
                                                            'id'=>'crimeName',
                                                            'name'=>'crimeName',
                                                            'type' => 'text',
                                                            'placeholder' => 'Crime Name',
                                                            'required' =>'required',
                                                            'autofocus'=>'autofocus'
                                                            );

                                                echo form_input($crimeName);                     
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <?php
                                $btn = array('class' => 'btn btn-primary btn-block',
                                            'value' => 'Add Crime',
                                            'name' => 'submit',
                                            'type' => 'submit');
                                echo form_submit($btn);        
                                echo form_close();
                            ?>                        
                        </div>                        
                    </div>
                    <center><h3>Crimes</h3></center>
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
                                $this->table->set_heading('Id', 'Crime Name', 'Date Added');
                                foreach ($crimes as $crime)
                                {                       
                                    $this->table->add_row($counter, $crime['CrimeName'], $crime['DateAdded']);
                                    $counter = $counter + 1;
                                }
                                $this->table->add_row('<b>Id</b>', '<b>Crime Name</b>', '<b>Date Added</b>');
                                $this->table->set_template($template);
                                echo $this->table->generate();
                            ?>
                        </div>
                    </div>                     
                    <!-- /.container-fluid -->                           