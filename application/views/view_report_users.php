                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Users Report</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>
                        <div id="printing">
                            <center><h3>Users Report</h3></center>
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
                                        $this->table->set_heading('User Id', 'First Name', 'Last Name', 'User Type', 'Email', 'Mobile No.', 'Last Login');
                                        foreach ($users as $user)
                                        {
                                            $this->table->add_row($counter, $user['FirstName'], $user['LastName'], $user['UserType'], $user['Email'], $user['MobileNo'], $user['LastLogin']);
                                            $counter = $counter + 1;
                                        }
                                        $this->table->add_row('<b>User Id</b>', '<b>First Name</b>', '<b>Last Name</b>', '<b>User Type</b>', '<b>Email</b>', '<b>Mobile No.</b>', '<b>Last Login</b>');
                                        $this->table->set_template($template);
                                        echo $this->table->generate();
                                    ?>
                                </div>
                            </div>
                        </div>                                                  
                        <?php
                            $btn = array('class' => 'btn btn-primary btn-block',
                                        'value' => 'Print',
                                        'name' => 'print',
                                        'onclick' => "printReport('printing')",
                                        'type' => 'button');
                            echo form_submit($btn);
                        ?>
                    </div>
                    <!-- /.container-fluid -->                           