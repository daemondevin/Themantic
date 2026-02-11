<?php
/**
 * Real-World Example: Dashboard
 * 
 * A complete admin dashboard demonstrating:
 * - Statistics cards
 * - Charts and graphs
 * - Data tables
 * - Recent activity feed
 * - Quick actions
 */

if (!isset($themantic)) {
    die('Themantic not initialized');
}

// Sample data (in real app, fetch from database)
$stats = [
    'revenue' => ['value' => '$24,300', 'change' => '+12.5%', 'trend' => 'up'],
    'orders' => ['value' => '1,428', 'change' => '+8.2%', 'trend' => 'up'],
    'customers' => ['value' => '8,549', 'change' => '+3.7%', 'trend' => 'up'],
    'conversion' => ['value' => '3.24%', 'change' => '-0.4%', 'trend' => 'down'],
];

$recentOrders = [
    ['id' => '#12345', 'customer' => 'John Doe', 'amount' => '$129.00', 'status' => 'completed'],
    ['id' => '#12344', 'customer' => 'Jane Smith', 'amount' => '$89.50', 'status' => 'pending'],
    ['id' => '#12343', 'customer' => 'Bob Johnson', 'amount' => '$249.99', 'status' => 'completed'],
    ['id' => '#12342', 'customer' => 'Alice Brown', 'amount' => '$34.99', 'status' => 'cancelled'],
    ['id' => '#12341', 'customer' => 'Charlie Wilson', 'amount' => '$179.00', 'status' => 'completed'],
];

$activities = [
    ['icon' => 'shopping cart', 'color' => 'blue', 'text' => 'New order #12345', 'time' => '2 minutes ago'],
    ['icon' => 'user plus', 'color' => 'green', 'text' => 'New customer registered', 'time' => '15 minutes ago'],
    ['icon' => 'dollar sign', 'color' => 'teal', 'text' => 'Payment received $129.00', 'time' => '1 hour ago'],
    ['icon' => 'star', 'color' => 'yellow', 'text' => 'New review posted', 'time' => '2 hours ago'],
    ['icon' => 'warning sign', 'color' => 'orange', 'text' => 'Low stock alert: Product XYZ', 'time' => '3 hours ago'],
];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Themantic Example</title>
    <style>
        body {
            background: #f5f5f5;
        }
        .dashboard-header {
            background: white;
            padding: 2em;
            margin-bottom: 2em;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stat-card {
            padding: 1.5em;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stat-value {
            font-size: 2em;
            font-weight: bold;
            margin: 0.25em 0;
        }
        .stat-label {
            color: #666;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 0.5px;
        }
        .stat-change {
            margin-top: 0.5em;
            font-size: 0.9em;
        }
        .stat-change.up {
            color: #21ba45;
        }
        .stat-change.down {
            color: #db2828;
        }
        .chart-container {
            background: white;
            padding: 1.5em;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2em;
        }
        .activity-item {
            padding: 1em;
            border-bottom: 1px solid #f0f0f0;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .quick-action {
            text-align: center;
            padding: 1em;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }
        .quick-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .quick-action i {
            font-size: 2em;
            margin-bottom: 0.5em;
        }
    </style>
</head>
<body>

    <!-- Top Navigation -->
    <div class="ui inverted menu" style="margin: 0; border-radius: 0;">
        <div class="ui container">
            <a class="header item">
                <i class="dashboard icon"></i>
                Dashboard
            </a>
            <a class="item">Products</a>
            <a class="item">Orders</a>
            <a class="item">Customers</a>
            <a class="item">Reports</a>
            <div class="right menu">
                <div class="item">
                    <div class="ui icon input">
                        <input type="text" placeholder="Search...">
                        <i class="search icon"></i>
                    </div>
                </div>
                <a class="item">
                    <i class="bell icon"></i>
                    <div class="ui red floating label">3</div>
                </a>
                <div class="ui dropdown item">
                    <i class="user circle icon"></i> Admin
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item">Profile</a>
                        <a class="item">Settings</a>
                        <div class="divider"></div>
                        <a class="item">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ui container" style="margin-top: 2em;">

        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="ui header">
                Dashboard
                <div class="sub header">Welcome back! Here's what's happening with your store today.</div>
            </h1>
        </div>

        <!-- Statistics Cards -->
        <div class="ui four column stackable grid">
            <?php
            $statConfigs = [
                ['label' => 'Total Revenue', 'icon' => 'dollar sign', 'color' => 'green', 'key' => 'revenue'],
                ['label' => 'Orders', 'icon' => 'shopping cart', 'color' => 'blue', 'key' => 'orders'],
                ['label' => 'Customers', 'icon' => 'users', 'color' => 'violet', 'key' => 'customers'],
                ['label' => 'Conversion Rate', 'icon' => 'chart line', 'color' => 'orange', 'key' => 'conversion'],
            ];
            
            foreach ($statConfigs as $config) {
                $stat = $stats[$config['key']];
                ?>
                <div class="column">
                    <div class="stat-card">
                        <div class="ui <?php echo $config['color']; ?> circular label" style="float: right;">
                            <i class="<?php echo $config['icon']; ?> icon"></i>
                        </div>
                        <div class="stat-label"><?php echo $config['label']; ?></div>
                        <div class="stat-value"><?php echo $stat['value']; ?></div>
                        <div class="stat-change <?php echo $stat['trend']; ?>">
                            <i class="arrow <?php echo $stat['trend']; ?> icon"></i>
                            <?php echo $stat['change']; ?> from last month
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Charts and Tables Row -->
        <div class="ui two column stackable grid" style="margin-top: 2em;">
            
            <!-- Sales Chart -->
            <div class="column">
                <div class="chart-container">
                    <h3 class="ui header">
                        <i class="chart bar icon"></i>
                        Sales Overview
                    </h3>
                    <canvas id="sales-chart" height="200"></canvas>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="column">
                <div class="chart-container">
                    <h3 class="ui header">
                        <i class="list icon"></i>
                        Recent Orders
                    </h3>
                    <table class="ui very basic table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td><strong><?php echo $order['id']; ?></strong></td>
                                <td><?php echo $order['customer']; ?></td>
                                <td><?php echo $order['amount']; ?></td>
                                <td>
                                    <?php
                                    $statusColors = [
                                        'completed' => 'green',
                                        'pending' => 'yellow',
                                        'cancelled' => 'red',
                                    ];
                                    $color = $statusColors[$order['status']] ?? 'grey';
                                    echo $themantic->render('label', [
                                        'text' => ucfirst($order['status']),
                                        'color' => $color,
                                        'size' => 'tiny'
                                    ]);
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                    echo $themantic->render('button', [
                        'text' => 'View All Orders',
                        'basic' => true,
                        'fluid' => true
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions and Activity -->
        <div class="ui two column stackable grid" style="margin-top: 2em;">
            
            <!-- Quick Actions -->
            <div class="column">
                <div class="chart-container">
                    <h3 class="ui header">
                        <i class="lightning icon"></i>
                        Quick Actions
                    </h3>
                    <div class="ui four column grid">
                        <div class="column">
                            <div class="quick-action" onclick="quickAction('new-order')">
                                <i class="plus circle blue icon"></i>
                                <div>New Order</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="quick-action" onclick="quickAction('new-product')">
                                <i class="box green icon"></i>
                                <div>Add Product</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="quick-action" onclick="quickAction('new-customer')">
                                <i class="user plus violet icon"></i>
                                <div>New Customer</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="quick-action" onclick="quickAction('report')">
                                <i class="file alternate orange icon"></i>
                                <div>Generate Report</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="column">
                <div class="chart-container">
                    <h3 class="ui header">
                        <i class="history icon"></i>
                        Recent Activity
                    </h3>
                    <div class="ui relaxed divided list">
                        <?php foreach ($activities as $activity): ?>
                        <div class="activity-item">
                            <i class="<?php echo $activity['icon'] . ' ' . $activity['color']; ?> icon"></i>
                            <div class="content" style="display: inline-block; vertical-align: middle;">
                                <div class="description"><?php echo $activity['text']; ?></div>
                                <div class="meta" style="color: #999; font-size: 0.9em;">
                                    <?php echo $activity['time']; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    echo $themantic->render('button', [
                        'text' => 'View All Activity',
                        'basic' => true,
                        'fluid' => true
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; padding: 2em 0; color: #999;">
            <p>© 2024 Your Company. Dashboard built with Themantic.</p>
        </div>

    </div>

    <!-- Chart.js for sales chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Initialize dropdown
    $('.ui.dropdown').dropdown();

    // Sales Chart
    var ctx = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales',
                data: [12000, 19000, 15000, 25000, 22000, 30000],
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Quick action handler
    function quickAction(action) {
        console.log('Quick action:', action);
        
        // Show modal based on action
        var modals = {
            'new-order': 'Create New Order',
            'new-product': 'Add New Product',
            'new-customer': 'Add New Customer',
            'report': 'Generate Report'
        };
        
        alert(modals[action] + ' - This would open a form/modal');
    }

    // Auto-refresh dashboard data (demo)
    function refreshDashboard() {
        console.log('Refreshing dashboard...');
        // In real app: fetch fresh data via AJAX
    }

    // Refresh every 30 seconds
    // setInterval(refreshDashboard, 30000);
    </script>
</body>
</html>
