                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
                            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                        </div>

                        <div>
                            <?php 
                                echo form_open('main/addusertodb');
                            ?>
                            <center><h3>Details</h3></center>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $userId = array('class' => 'form-control',
                                                            'id'=>'userId',
                                                            'name'=>'userId',
                                                            'title'=>'User Id',
                                                            'type' => 'text',
                                                            'value' => $user[0]['UserId'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly',
                                                            'style'=> 'text-align:right;'
                                                            );

                                                echo form_input($userId);                     
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $userType = array('class' => 'form-control',
                                                            'id'=>'userType',
                                                            'name'=>'userType',
                                                            'title'=>'User Type',
                                                            'type' => 'text',
                                                            'value' => $user[0]['UserType'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($userType);                     
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $firstName = array('class' => 'form-control',
                                                            'id'=>'firstName',
                                                            'name'=>'firstName',
                                                            'title'=>'First Name',
                                                            'type' => 'text',
                                                            'value' => $user[0]['FirstName'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($firstName);                     
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php 
                                                $lastName = array('class' => 'form-control',
                                                            'id'=>'lastName',
                                                            'name'=>'lastName',
                                                            'title'=>'Last Name',
                                                            'type' => 'text',
                                                            'value' => $user[0]['LastName'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($lastName);                     
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $email = array('class' => 'form-control',
                                                            'id'=>'email',
                                                            'name'=>'email',
                                                            'title'=>'Email',
                                                            'type' => 'email',
                                                            'value' => $user[0]['Email'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($email);                     
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $mobileNumber = array('class' => 'form-control',
                                                            'id'=>'mobileNumber',
                                                            'name'=>'mobileNumber',
                                                            'title'=>'Mobile Number',
                                                            'type' => 'text',
                                                            'value' => $user[0]['MobileNo'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($mobileNumber);              
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group">
                                <div class="form-row">                                
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $lastLogin = array('class' => 'form-control',
                                                            'id'=>'lastLogin',
                                                            'name'=>'lastLogin',
                                                            'title'=>'Last Login',
                                                            'type' => 'text',
                                                            'value' => $user[0]['LastLogin'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($lastLogin);                     
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <?php
                                                $createdDate = array('class' => 'form-control',
                                                            'id'=>'createdDate',
                                                            'name'=>'createdDate',
                                                            'title'=>'Created Date',
                                                            'type' => 'text',
                                                            'value' => $user[0]['CreatedDate'],
                                                            'required' =>'required',
                                                            'readonly'=>'readonly'
                                                            );

                                                echo form_input($createdDate);              
                                            ?>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->                           