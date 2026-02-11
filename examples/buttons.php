<?php
/**
 * Basic Button Examples
 * 
 * Demonstrates various button styles and configurations
 */

// Ensure Themantic is loaded
if (!isset($themantic)) {
    die('Themantic not initialized');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Button Examples - Themantic</title>
</head>
<body>
    <div class="ui container" style="margin-top: 2em;">
        
        <h1 class="ui header">Button Examples</h1>
        <div class="ui divider"></div>

        <!-- Basic Buttons -->
        <h2 class="ui header">Basic Buttons</h2>
        <div class="ui segment">
            <?php
            // Simple button
            echo $themantic->render('button', [
                'text' => 'Button'
            ]);
            echo ' ';
            
            // Button with icon
            echo $themantic->render('button', [
                'text' => 'Icon Button',
                'icon' => 'download'
            ]);
            echo ' ';
            
            // Icon only button
            echo $themantic->render('button', [
                'icon' => 'heart'
            ]);
            ?>
        </div>

        <!-- Colored Buttons -->
        <h2 class="ui header">Colored Buttons</h2>
        <div class="ui segment">
            <?php
            $colors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black'];
            
            foreach ($colors as $color) {
                echo $themantic->render('button', [
                    'text' => ucfirst($color),
                    'color' => $color
                ]);
                echo ' ';
            }
            ?>
        </div>

        <!-- Sized Buttons -->
        <h2 class="ui header">Sized Buttons</h2>
        <div class="ui segment">
            <?php
            $sizes = ['mini', 'tiny', 'small', 'medium', 'large', 'big', 'huge', 'massive'];
            
            foreach ($sizes as $size) {
                echo $themantic->render('button', [
                    'text' => ucfirst($size),
                    'size' => $size
                ]);
                echo ' ';
            }
            ?>
        </div>

        <!-- Button States -->
        <h2 class="ui header">Button States</h2>
        <div class="ui segment">
            <?php
            // Active button
            echo $themantic->render('button', [
                'text' => 'Active',
                'state' => 'active'
            ]);
            echo ' ';
            
            // Disabled button
            echo $themantic->render('button', [
                'text' => 'Disabled',
                'disabled' => true
            ]);
            echo ' ';
            
            // Loading button
            echo $themantic->render('button', [
                'text' => 'Loading',
                'loading' => true
            ]);
            ?>
        </div>

        <!-- Button Variations -->
        <h2 class="ui header">Button Variations</h2>
        
        <h3 class="ui header">Basic</h3>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Basic Button',
                'basic' => true
            ]);
            echo ' ';
            
            echo $themantic->render('button', [
                'text' => 'Basic Blue',
                'color' => 'blue',
                'basic' => true
            ]);
            ?>
        </div>

        <h3 class="ui header">Inverted</h3>
        <div class="ui inverted segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Inverted',
                'inverted' => true
            ]);
            echo ' ';
            
            echo $themantic->render('button', [
                'text' => 'Inverted Blue',
                'color' => 'blue',
                'inverted' => true
            ]);
            ?>
        </div>

        <h3 class="ui header">Compact</h3>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Compact',
                'compact' => true
            ]);
            echo ' ';
            
            echo $themantic->render('button', [
                'text' => 'Normal'
            ]);
            ?>
        </div>

        <h3 class="ui header">Circular</h3>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'icon' => 'heart',
                'circular' => true
            ]);
            echo ' ';
            
            echo $themantic->render('button', [
                'icon' => 'star',
                'color' => 'blue',
                'circular' => true
            ]);
            ?>
        </div>

        <h3 class="ui header">Fluid</h3>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Fluid Button',
                'fluid' => true
            ]);
            ?>
        </div>

        <!-- Animated Buttons -->
        <h2 class="ui header">Animated Buttons</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Next',
                'animated' => 'fade',
                'animatedText' => 'Go',
                'icon' => 'arrow right'
            ]);
            echo ' ';
            
            echo $themantic->render('button', [
                'text' => 'Sign Up',
                'animated' => 'vertical',
                'animatedText' => 'Free',
                'color' => 'green'
            ]);
            ?>
        </div>

        <!-- Labeled Buttons -->
        <h2 class="ui header">Labeled Buttons</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Like',
                'icon' => 'heart',
                'iconPosition' => 'left'
            ]);
            echo ' ';
            
            echo $themantic->render('button', [
                'text' => 'Save',
                'icon' => 'save',
                'iconPosition' => 'right'
            ]);
            ?>
        </div>

        <!-- Button as Link -->
        <h2 class="ui header">Button as Link</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Visit Google',
                'tag' => 'a',
                'href' => 'https://google.com',
                'target' => '_blank',
                'color' => 'blue'
            ]);
            ?>
        </div>

        <!-- Social Buttons -->
        <h2 class="ui header">Social Buttons</h2>
        <div class="ui segment">
            <?php
            $socialButtons = [
                ['icon' => 'facebook', 'color' => 'facebook', 'text' => 'Facebook'],
                ['icon' => 'twitter', 'color' => 'twitter', 'text' => 'Twitter'],
                ['icon' => 'google plus', 'color' => 'google plus', 'text' => 'Google'],
                ['icon' => 'linkedin', 'color' => 'linkedin', 'text' => 'LinkedIn'],
                ['icon' => 'youtube', 'color' => 'youtube', 'text' => 'YouTube'],
                ['icon' => 'instagram', 'color' => 'instagram', 'text' => 'Instagram'],
            ];
            
            foreach ($socialButtons as $social) {
                echo $themantic->render('button', $social);
                echo ' ';
            }
            ?>
        </div>

        <!-- Attached Buttons -->
        <h2 class="ui header">Attached Buttons</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Top',
                'attached' => 'top'
            ]);
            ?>
            <div class="ui attached segment">
                <p>Content here</p>
            </div>
            <?php
            echo $themantic->render('button', [
                'text' => 'Bottom',
                'attached' => 'bottom'
            ]);
            ?>
        </div>

        <!-- Floated Buttons -->
        <h2 class="ui header">Floated Buttons</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Left Floated',
                'floated' => 'left'
            ]);
            
            echo $themantic->render('button', [
                'text' => 'Right Floated',
                'floated' => 'right'
            ]);
            ?>
            <div style="clear: both;"></div>
        </div>

        <!-- Button Groups -->
        <h2 class="ui header">Button Groups</h2>
        <div class="ui segment">
            <div class="ui buttons">
                <?php
                echo $themantic->render('button', ['text' => 'One']);
                echo $themantic->render('button', ['text' => 'Two']);
                echo $themantic->render('button', ['text' => 'Three']);
                ?>
            </div>
        </div>

        <!-- Conditional Buttons -->
        <h2 class="ui header">Conditional Buttons</h2>
        <div class="ui segment">
            <div class="ui buttons">
                <?php
                echo $themantic->render('button', ['text' => 'Cancel']);
                ?>
                <div class="or"></div>
                <?php
                echo $themantic->render('button', [
                    'text' => 'Save',
                    'color' => 'green'
                ]);
                ?>
            </div>
        </div>

        <!-- Interactive Example with Data Attributes -->
        <h2 class="ui header">Interactive Button (Data Attributes)</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Click Me',
                'color' => 'blue',
                'id' => 'interactive-btn',
                'data-value' => 'test',
                'data-action' => 'alert',
                'onClick' => 'alert("Button clicked! Value: " + this.dataset.value)'
            ]);
            ?>
        </div>

        <!-- Accessibility Example -->
        <h2 class="ui header">Accessible Button</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('button', [
                'text' => 'Submit Form',
                'color' => 'green',
                'aria-label' => 'Submit contact form',
                'aria-describedby' => 'form-help',
                'type' => 'submit'
            ]);
            ?>
            <p id="form-help" class="ui small text">
                This button will submit your contact form
            </p>
        </div>

    </div>
</body>
</html>
