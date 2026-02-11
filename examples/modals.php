<?php
/**
 * Modal Examples
 * 
 * Demonstrates modal dialogs and interactions
 */

if (!isset($themantic)) {
    die('Themantic not initialized');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Modal Examples - Themantic</title>
</head>
<body>
    <div class="ui container" style="margin-top: 2em;">
        
        <h1 class="ui header">Modal Examples</h1>
        <div class="ui divider"></div>

        <!-- Basic Modal -->
        <h2 class="ui header">Basic Modal</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Show Basic Modal',
                'color' => 'blue',
                'onClick' => "$('#basic-modal').modal('show')"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'basic-modal',
                'header' => 'Modal Title',
                'content' => 'This is a basic modal with some content.',
                'actions' => [
                    ['text' => 'Cancel', 'class' => 'deny'],
                    ['text' => 'OK', 'class' => 'approve green']
                ]
            ]);
            ?>
        </div>

        <!-- Modal with Long Content -->
        <h2 class="ui header">Modal with Scrolling Content</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Show Scrolling Modal',
                'color' => 'teal',
                'onClick' => "$('#scrolling-modal').modal('show')"
            ]);
            
            $longContent = str_repeat('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 20);
            
            echo $themantic->render('modal', [
                'id' => 'scrolling-modal',
                'header' => 'Long Content Modal',
                'content' => $longContent,
                'scrolling' => true,
                'actions' => [
                    ['text' => 'Close', 'class' => 'approve']
                ]
            ]);
            ?>
        </div>

        <!-- Full Screen Modal -->
        <h2 class="ui header">Full Screen Modal</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Show Full Screen Modal',
                'color' => 'violet',
                'onClick' => "$('#fullscreen-modal').modal('show')"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'fullscreen-modal',
                'header' => 'Full Screen Modal',
                'content' => '<div class="ui container"><h2>Full Screen Content</h2><p>This modal takes up the entire screen.</p></div>',
                'fullscreen' => true,
                'actions' => [
                    ['text' => 'Close', 'class' => 'approve']
                ]
            ]);
            ?>
        </div>

        <!-- Confirmation Modal -->
        <h2 class="ui header">Confirmation Modal</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Delete Item',
                'color' => 'red',
                'onClick' => "$('#confirm-modal').modal('show')"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'confirm-modal',
                'size' => 'tiny',
                'header' => 'Confirm Deletion',
                'content' => '<div class="content"><p>Are you sure you want to delete this item? This action cannot be undone.</p></div>',
                'actions' => [
                    ['text' => 'Cancel', 'class' => 'deny'],
                    ['text' => 'Delete', 'class' => 'approve red', 'icon' => 'trash']
                ]
            ]);
            ?>
            
            <script>
            $('#confirm-modal').modal({
                onApprove: function() {
                    alert('Item deleted!');
                    return true;
                },
                onDeny: function() {
                    alert('Deletion cancelled');
                    return true;
                }
            });
            </script>
        </div>

        <!-- Modal with Form -->
        <h2 class="ui header">Modal with Form</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Add New User',
                'color' => 'green',
                'icon' => 'plus',
                'onClick' => "$('#form-modal').modal('show')"
            ]);
            
            $formContent = '
                <form class="ui form" id="user-form">
                    <div class="field">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="field">
                        <label>Role</label>
                        <select name="role" class="ui dropdown">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="guest">Guest</option>
                        </select>
                    </div>
                </form>
            ';
            
            echo $themantic->render('modal', [
                'id' => 'form-modal',
                'header' => 'Add New User',
                'content' => $formContent,
                'actions' => [
                    ['text' => 'Cancel', 'class' => 'deny'],
                    ['text' => 'Save', 'class' => 'approve blue', 'icon' => 'checkmark']
                ]
            ]);
            ?>
            
            <script>
            $('#form-modal').modal({
                onApprove: function() {
                    var form = $('#user-form')[0];
                    if (form.checkValidity()) {
                        alert('User saved!');
                        return true;
                    } else {
                        form.reportValidity();
                        return false;
                    }
                }
            });
            
            $('.ui.dropdown').dropdown();
            </script>
        </div>

        <!-- Sized Modals -->
        <h2 class="ui header">Modal Sizes</h2>
        <div class="ui segment">
            <?php
            $sizes = ['mini', 'tiny', 'small', 'large'];
            
            foreach ($sizes as $size) {
                echo $themantic->render('button', [
                    'text' => ucfirst($size),
                    'onClick' => "$('#{$size}-modal').modal('show')"
                ]);
                echo ' ';
                
                echo $themantic->render('modal', [
                    'id' => "{$size}-modal",
                    'size' => $size,
                    'header' => ucfirst($size) . ' Modal',
                    'content' => "This is a {$size} modal.",
                    'actions' => [
                        ['text' => 'Close', 'class' => 'approve']
                    ]
                ]);
            }
            ?>
        </div>

        <!-- Image Modal -->
        <h2 class="ui header">Image Modal</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'View Image',
                'color' => 'orange',
                'icon' => 'image',
                'onClick' => "$('#image-modal').modal('show')"
            ]);
            
            $imageContent = '
                <div class="image content">
                    <div class="ui medium image">
                        <img src="https://semantic-ui.com/images/wireframe/image.png">
                    </div>
                    <div class="description">
                        <div class="ui header">Image Title</div>
                        <p>This is an image modal with description.</p>
                        <p>You can include additional information about the image here.</p>
                    </div>
                </div>
            ';
            
            echo $themantic->render('modal', [
                'id' => 'image-modal',
                'header' => 'Image Preview',
                'content' => $imageContent,
                'actions' => [
                    ['text' => 'Download', 'class' => 'blue', 'icon' => 'download'],
                    ['text' => 'Close', 'class' => 'deny']
                ]
            ]);
            ?>
        </div>

        <!-- Multiple Modals (Stacking) -->
        <h2 class="ui header">Multiple Modals</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Open First Modal',
                'color' => 'purple',
                'onClick' => "$('#first-modal').modal('show')"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'first-modal',
                'header' => 'First Modal',
                'content' => '<p>This is the first modal. Click the button below to open a second modal.</p>',
                'actions' => [
                    ['text' => 'Open Second Modal', 'class' => 'blue', 'onClick' => "$('#second-modal').modal('show')"],
                    ['text' => 'Close', 'class' => 'deny']
                ]
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'second-modal',
                'size' => 'tiny',
                'header' => 'Second Modal',
                'content' => '<p>This is the second modal, opened from the first one!</p>',
                'actions' => [
                    ['text' => 'Close', 'class' => 'approve green']
                ]
            ]);
            ?>
            
            <script>
            $('#first-modal, #second-modal').modal({
                allowMultiple: true
            });
            </script>
        </div>

        <!-- Modal with Custom Actions -->
        <h2 class="ui header">Custom Action Buttons</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Show Custom Actions',
                'color' => 'brown',
                'onClick' => "$('#custom-actions-modal').modal('show')"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'custom-actions-modal',
                'header' => 'Choose an Action',
                'content' => '<p>Select one of the actions below:</p>',
                'actions' => [
                    ['text' => 'Save Draft', 'class' => 'basic', 'icon' => 'save outline'],
                    ['text' => 'Delete', 'class' => 'basic red', 'icon' => 'trash'],
                    ['text' => 'Publish', 'class' => 'green', 'icon' => 'checkmark']
                ]
            ]);
            ?>
        </div>

        <!-- Modal with Loading State -->
        <h2 class="ui header">Modal with Loading</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Load Data',
                'color' => 'blue',
                'onClick' => "showLoadingModal()"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'loading-modal',
                'header' => 'Loading Data',
                'content' => '<div class="ui active centered inline loader"></div><p style="text-align:center; margin-top: 2em;">Please wait while we fetch your data...</p>',
                'actions' => [
                    ['text' => 'Cancel', 'class' => 'deny']
                ]
            ]);
            ?>
            
            <script>
            function showLoadingModal() {
                $('#loading-modal').modal('show');
                
                // Simulate loading
                setTimeout(function() {
                    $('#loading-modal').modal('hide');
                    alert('Data loaded!');
                }, 3000);
            }
            </script>
        </div>

        <!-- Inverted Modal -->
        <h2 class="ui header">Inverted Modal</h2>
        <div class="ui inverted segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Show Inverted Modal',
                'inverted' => true,
                'onClick' => "$('#inverted-modal').modal('show')"
            ]);
            
            echo $themantic->render('modal', [
                'id' => 'inverted-modal',
                'inverted' => true,
                'header' => 'Inverted Modal',
                'content' => '<p>This modal has an inverted (dark) color scheme.</p>',
                'actions' => [
                    ['text' => 'Close', 'class' => 'approve inverted']
                ]
            ]);
            ?>
        </div>

    </div>

    <script>
    // Initialize all modals
    $('.ui.modal').modal({
        duration: 200,
        transition: 'scale'
    });
    </script>
</body>
</html>
