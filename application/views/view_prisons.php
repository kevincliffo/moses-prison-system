                    
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Prisons</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
                                        $this->table->set_heading('Prison Id', 'Name', 'County', 'Remove Prison');
                                        foreach ($prisons as $prison)
                                        {
                                            $this->table->add_row($counter, $prison['Name'], $prison['County'], anchor('prisons/removeprison/'.$prison['Id'], 'Remove'));
                                            $counter = $counter + 1;
                                        }
                                        $this->table->add_row('<b>Prison Id</b>', '<b>Name</b>', '<b>County</b>', '<b>Remove Prison</b>');
                                        $this->table->set_template($template);
                                        echo $this->table->generate();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->                        