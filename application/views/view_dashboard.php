
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userscount; ?></div>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Prisons</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $prisonscount; ?></div>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-bars fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prisoners</div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $prisonerscount; ?></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-lock fa-2x text-gray-300"></i>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pending Requests Card Example -->
                            <!-- <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Reports</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $reports; ?></div>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">System Users</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                            $template = array(
                                                'table_open'=> '<table border="0" cellpadding="0" class="table table-bordered">',                                        
                                                'id'=>'dataTable',
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
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Prisoners</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                            $template = array(
                                                'table_open'=> '<table border="0" cellpadding="0" class="table table-bordered">',                                        
                                                'id'=>'dataTable',
                                                'width'=>'100%',
                                                'cellspacing'=>'0'
                                            );
                                
                                            $counter = 1;
                                            $this->table->set_heading('Id', 'First Name', 'Last Name', 'ID Number', 'Crime', 'Crime County', 'Details', 'Prison', 'Sentence Date', 'Release Date');
                                            foreach ($prisoners as $prisoner)
                                            {
                                                $this->table->add_row($counter, $prisoner['FirstName'], $prisoner['LastName'], $prisoner['IDNumber'], $prisoner['Crime'], $prisoner['CrimeCounty'], $prisoner['Details'], $prisoner['Prison'], $prisoner['SentenceDate'], $prisoner['ReleaseDate']);
                                                $counter = $counter + 1;
                                            }
                                            $this->table->add_row('<b>Id</b>', '<b>First Name</b>', '<b>Last Name</b>', '<b>ID Number</b>', '<b>Crime</b>', '<b>Crime County</b>', '<b>Details</b>', '<b>Prison</b>', '<b>Sentence Date</b>', '<b>Release Date</b>');
                                            $this->table->set_template($template);
                                            echo $this->table->generate();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Prisons</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                            $template = array(
                                                'table_open'=> '<table border="0" cellpadding="0" class="table table-bordered">',                                        
                                                'id'=>'dataTable',
                                                'width'=>'100%',
                                                'cellspacing'=>'0'
                                            );
                                
                                            $counter = 1;
                                            $this->table->set_heading('Prison Id', 'Name', 'County');
                                            foreach ($prisons as $prison)
                                            {
                                                $this->table->add_row($counter, $prison['Name'], $prison['County']);
                                                $counter = $counter + 1;
                                            }
                                            $this->table->add_row('<b>Prison Id</b>', '<b>Name</b>', '<b>County</b>');
                                            $this->table->set_template($template);
                                            echo $this->table->generate();
                                        ?>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- /.container-fluid -->
