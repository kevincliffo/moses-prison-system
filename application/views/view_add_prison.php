                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Add Prison</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>

                        <div>
                            <?php 
                                echo form_open('prisons/addprisontodb');
                            ?>
                            <center><h3>Prisoner Details</h3></center>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $prisonName = array('class' => 'form-control',
                                                            'id'=>'prisonName',
                                                            'name'=>'prisonName',
                                                            'type' => 'text',
                                                            'placeholder' => 'Prison Name',
                                                            'required' =>'required',
                                                            'autofocus'=>'autofocus'
                                                            );

                                                echo form_input($prisonName);                     
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <select id="county" name="county" class="form-control" required>
                                                <option selected disabled>Select County</option>
                                                <?php 
                                                    foreach($counties as $county)
                                                    {
                                                        echo '<option value='.$county['County']. '>'.$county['County'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <?php
                                $btn = array('class' => 'btn btn-primary btn-block',
                                            'value' => 'Add Prison',
                                            'name' => 'submit',
                                            'type' => 'submit');
                                echo form_submit($btn);        
                                echo form_close();
                            ?>
                        </div>
                    </div>
                    <!-- /.container-fluid -->                           