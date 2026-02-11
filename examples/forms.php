<?php
/**
 * Form Examples
 * 
 * Demonstrates form building with Themantic
 */

if (!isset($themantic)) {
    die('Themantic not initialized');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Examples - Themantic</title>
</head>
<body>
    <div class="ui container" style="margin-top: 2em;">
        
        <h1 class="ui header">Form Examples</h1>
        <div class="ui divider"></div>

        <!-- Simple Contact Form -->
        <h2 class="ui header">Simple Contact Form</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('form', [
                'id' => 'contact-form',
                'action' => '/contact/submit',
                'method' => 'post',
                'fields' => [
                    [
                        'type' => 'text',
                        'name' => 'name',
                        'label' => 'Name',
                        'placeholder' => 'Enter your name',
                        'required' => true,
                    ],
                    [
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email',
                        'placeholder' => 'your@email.com',
                        'required' => true,
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'message',
                        'label' => 'Message',
                        'placeholder' => 'Your message here...',
                        'rows' => 4,
                        'required' => true,
                    ],
                ],
                'submit' => [
                    'text' => 'Send Message',
                    'color' => 'blue',
                    'icon' => 'send',
                ]
            ]);
            ?>
        </div>

        <!-- Registration Form -->
        <h2 class="ui header">Registration Form</h2>
        <div class="ui segment">
            <form class="ui form">
                <h4 class="ui dividing header">Account Information</h4>
                
                <div class="field">
                    <label>Username</label>
                    <?php
                    echo $themantic->render('input', [
                        'type' => 'text',
                        'name' => 'username',
                        'placeholder' => 'Choose a username',
                        'icon' => 'user',
                        'iconPosition' => 'left'
                    ]);
                    ?>
                </div>
                
                <div class="field">
                    <label>Email</label>
                    <?php
                    echo $themantic->render('input', [
                        'type' => 'email',
                        'name' => 'email',
                        'placeholder' => 'your@email.com',
                        'icon' => 'mail',
                        'iconPosition' => 'left'
                    ]);
                    ?>
                </div>
                
                <div class="two fields">
                    <div class="field">
                        <label>Password</label>
                        <?php
                        echo $themantic->render('input', [
                            'type' => 'password',
                            'name' => 'password',
                            'placeholder' => 'Password',
                            'icon' => 'lock',
                            'iconPosition' => 'left'
                        ]);
                        ?>
                    </div>
                    <div class="field">
                        <label>Confirm Password</label>
                        <?php
                        echo $themantic->render('input', [
                            'type' => 'password',
                            'name' => 'password_confirm',
                            'placeholder' => 'Confirm password',
                            'icon' => 'lock',
                            'iconPosition' => 'left'
                        ]);
                        ?>
                    </div>
                </div>
                
                <h4 class="ui dividing header">Personal Information</h4>
                
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="First Name">
                </div>
                
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Last Name">
                </div>
                
                <div class="field">
                    <label>Gender</label>
                    <select name="gender" class="ui dropdown">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="inline field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="terms" tabindex="0">
                        <label>I agree to the Terms and Conditions</label>
                    </div>
                </div>
                
                <?php
                echo $themantic->render('button', [
                    'text' => 'Register',
                    'type' => 'submit',
                    'color' => 'green',
                    'fluid' => true,
                    'size' => 'large'
                ]);
                ?>
            </form>
        </div>

        <!-- Search Form -->
        <h2 class="ui header">Search Form</h2>
        <div class="ui segment">
            <form class="ui form">
                <div class="field">
                    <?php
                    echo $themantic->render('input', [
                        'type' => 'text',
                        'name' => 'search',
                        'placeholder' => 'Search...',
                        'icon' => 'search',
                        'iconPosition' => 'left',
                        'action' => [
                            'text' => 'Search',
                            'color' => 'blue'
                        ]
                    ]);
                    ?>
                </div>
            </form>
        </div>

        <!-- Login Form -->
        <h2 class="ui header">Login Form</h2>
        <div class="ui segment">
            <form class="ui large form">
                <div class="field">
                    <label>Email</label>
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="Email address">
                    </div>
                </div>
                <div class="field">
                    <label>Password</label>
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="remember">
                        <label>Remember Me</label>
                    </div>
                </div>
                <?php
                echo $themantic->render('button', [
                    'text' => 'Login',
                    'type' => 'submit',
                    'color' => 'blue',
                    'fluid' => true,
                    'size' => 'large'
                ]);
                ?>
            </form>
            
            <div class="ui horizontal divider">Or</div>
            
            <div class="ui two column grid">
                <div class="column">
                    <?php
                    echo $themantic->render('button', [
                        'text' => 'Facebook',
                        'icon' => 'facebook',
                        'color' => 'facebook',
                        'fluid' => true
                    ]);
                    ?>
                </div>
                <div class="column">
                    <?php
                    echo $themantic->render('button', [
                        'text' => 'Google',
                        'icon' => 'google',
                        'color' => 'google plus',
                        'fluid' => true
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- Inline Form -->
        <h2 class="ui header">Inline Form</h2>
        <div class="ui segment">
            <form class="ui form">
                <div class="inline fields">
                    <div class="field">
                        <label>Name</label>
                        <input type="text" placeholder="First name">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Last name">
                    </div>
                    <div class="field">
                        <?php
                        echo $themantic->render('button', [
                            'text' => 'Submit',
                            'color' => 'blue'
                        ]);
                        ?>
                    </div>
                </div>
            </form>
        </div>

        <!-- Form Validation States -->
        <h2 class="ui header">Form Validation States</h2>
        <div class="ui segment">
            <form class="ui form">
                <div class="field success">
                    <label>Valid Input</label>
                    <input type="text" value="john@example.com">
                    <div class="ui success message">
                        <p>Email is valid!</p>
                    </div>
                </div>
                
                <div class="field error">
                    <label>Invalid Input</label>
                    <input type="text" value="invalid-email">
                    <div class="ui error message">
                        <p>Please enter a valid email address</p>
                    </div>
                </div>
                
                <div class="field warning">
                    <label>Warning Input</label>
                    <input type="text" value="short">
                    <div class="ui warning message">
                        <p>Password should be at least 8 characters</p>
                    </div>
                </div>
            </form>
        </div>

        <!-- Disabled Form -->
        <h2 class="ui header">Disabled Form</h2>
        <div class="ui segment">
            <form class="ui form">
                <div class="disabled field">
                    <label>Disabled Input</label>
                    <input type="text" placeholder="Can't type here" disabled>
                </div>
                <div class="disabled field">
                    <label>Disabled Dropdown</label>
                    <select class="ui dropdown" disabled>
                        <option value="">Select</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Loading Form -->
        <h2 class="ui header">Loading Form</h2>
        <div class="ui segment">
            <form class="ui loading form">
                <div class="field">
                    <label>Name</label>
                    <input type="text" placeholder="Name">
                </div>
                <div class="field">
                    <label>Email</label>
                    <input type="email" placeholder="Email">
                </div>
                <?php
                echo $themantic->render('button', [
                    'text' => 'Submit',
                    'type' => 'submit'
                ]);
                ?>
            </form>
        </div>

        <!-- Form with Fomantic Dropdown Integration -->
        <h2 class="ui header">Form with Dropdown Component</h2>
        <div class="ui segment">
            <form class="ui form">
                <div class="field">
                    <label>Country</label>
                    <?php
                    echo $themantic->render('dropdown', [
                        'name' => 'country',
                        'placeholder' => 'Select Country',
                        'options' => [
                            ['value' => 'us', 'text' => 'United States'],
                            ['value' => 'uk', 'text' => 'United Kingdom'],
                            ['value' => 'ca', 'text' => 'Canada'],
                            ['value' => 'au', 'text' => 'Australia'],
                        ],
                        'search' => true
                    ]);
                    ?>
                </div>
            </form>
        </div>

        <!-- File Upload Form -->
        <h2 class="ui header">File Upload Form</h2>
        <div class="ui segment">
            <form class="ui form">
                <div class="field">
                    <label>Upload Document</label>
                    <div class="ui action input">
                        <input type="text" placeholder="Choose file..." readonly id="file-name">
                        <input type="file" id="file-input" style="display:none;">
                        <label for="file-input" class="ui button">
                            <i class="upload icon"></i>
                            Browse
                        </label>
                    </div>
                </div>
                
                <?php
                echo $themantic->render('button', [
                    'text' => 'Upload',
                    'color' => 'green',
                    'icon' => 'cloud upload'
                ]);
                ?>
            </form>
            
            <script>
            document.getElementById('file-input').addEventListener('change', function(e) {
                var fileName = e.target.files[0]?.name || 'Choose file...';
                document.getElementById('file-name').value = fileName;
            });
            </script>
        </div>

    </div>
</body>
</html>
