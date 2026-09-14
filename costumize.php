<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$alert = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = strip_tags(trim($_POST["email"] ?? ''));
   
    if (empty($name) || empty($email)) {
        $alert = '<div class="alert alert-danger">Please provide your name and email.</div>';
    } else {
        // Calculate totals and selected services
        $initialTotal = 0;
        $monthlyTotal = 0;
        $selectedServices = [];
        // Base custom dev always included, but adjust for business type
        $initialTotal += 1400; // Base for 4 pages
        $selectedServices[] = '100% Custom Web Development ($1400 for 4 pages)';
        // Business type extras
        $businessType = $_POST['business-type'] ?? '';
        $businessData = [
            'ecommerce' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 1000, 'monthly' => 0, 'name' => 'Payment Gateway Integration ($1000)']],
                'extra_field' => 'products_count',
                'extra_label' => 'Product',
                'ask_sell' => false
            ],
            'blog' => [
                'min_pages' => 4,
                'integrations' => [['cost' => 450, 'monthly' => 0, 'name' => 'Blog Integration ($450)']],
                'extra_field' => null,
                'extra_label' => null,
                'ask_sell' => true
            ],
            'portfolio' => [
                'min_pages' => 4,
                'integrations' => [],
                'extra_field' => 'portfolio_items_count',
                'extra_label' => 'Portfolio Item',
                'ask_sell' => false
            ],
            'corporate' => [
                'min_pages' => 6,
                'integrations' => [],
                'extra_field' => 'services_count',
                'extra_label' => 'Service/Product',
                'ask_sell' => true
            ],
            'service' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'services_count',
                'extra_label' => 'Service',
                'ask_sell' => true
            ],
            'restaurant' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)']],
                'extra_field' => 'menu_items_count',
                'extra_label' => 'Menu Item/Event',
                'ask_sell' => false
            ],
            'realtor' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'properties_count',
                'extra_label' => 'Property',
                'ask_sell' => false
            ],
            'news' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 450, 'monthly' => 0, 'name' => 'Blog Integration ($450)']],
                'extra_field' => null,
                'extra_label' => null,
                'ask_sell' => true
            ],
            'artist' => [
                'min_pages' => 5,
                'integrations' => [],
                'extra_field' => 'artworks_count',
                'extra_label' => 'Artwork/Album',
                'ask_sell' => false
            ],
            'educational' => [
                'min_pages' => 6,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'courses_count',
                'extra_label' => 'Course',
                'ask_sell' => false
            ],
            'nonprofit' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'programs_count',
                'extra_label' => 'Program/Event',
                'ask_sell' => false
            ],
            'saas' => [
                'min_pages' => 6,
                'integrations' => [['cost' => 200, 'monthly' => 0, 'name' => 'External API Connection ($200)']],
                'extra_field' => 'features_count',
                'extra_label' => 'Feature',
                'ask_sell' => false
            ],
            'hotel' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)']],
                'extra_field' => 'rooms_count',
                'extra_label' => 'Room Type/Offer',
                'ask_sell' => false
            ],
            'medical' => [
                'min_pages' => 6,
                'integrations' => [
                    ['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)'],
                    ['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']
                ],
                'extra_field' => 'treatments_count',
                'extra_label' => 'Treatment',
                'ask_sell' => false
            ],
            'financial' => [
                'min_pages' => 6,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'services_count',
                'extra_label' => 'Service/Product',
                'ask_sell' => true
            ],
            'event' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)']],
                'extra_field' => 'packages_count',
                'extra_label' => 'Package/Event',
                'ask_sell' => false
            ],
            'podcast' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 200, 'monthly' => 0, 'name' => 'External API Connection ($200)']],
                'extra_field' => 'episodes_count',
                'extra_label' => 'Episode',
                'ask_sell' => false
            ],
            'personal' => [
                'min_pages' => 4,
                'integrations' => [],
                'extra_field' => null,
                'extra_label' => null,
                'ask_sell' => true
            ],
            'gym' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)']],
                'extra_field' => 'classes_count',
                'extra_label' => 'Class/Program',
                'ask_sell' => false
            ],
            'retail' => [
                'min_pages' => 5,
                'integrations' => [],
                'extra_field' => 'products_count',
                'extra_label' => 'Product',
                'ask_sell' => true
            ],
            'law' => [
                'min_pages' => 6,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'practice_areas_count',
                'extra_label' => 'Practice Area',
                'ask_sell' => false
            ],
            'travel' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)']],
                'extra_field' => 'destinations_count',
                'extra_label' => 'Destination/Package',
                'ask_sell' => false
            ],
            'beauty' => [
                'min_pages' => 5,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Calendar Integration ($400)']],
                'extra_field' => 'services_count',
                'extra_label' => 'Service',
                'ask_sell' => true
            ],
            'automotive' => [
                'min_pages' => 6,
                'integrations' => [['cost' => 400, 'monthly' => 0, 'name' => 'Dynamic Forms Integration ($400)']],
                'extra_field' => 'vehicles_count',
                'extra_label' => 'Vehicle/Service',
                'ask_sell' => true
            ],
            'photography' => [
                'min_pages' => 5,
                'integrations' => [],
                'extra_field' => 'galleries_count',
                'extra_label' => 'Gallery/Package',
                'ask_sell' => false
            ]
        ];
        $extraLabels = [
            'products_count' => 'Product',
            'services_count' => 'Service',
            'portfolio_items_count' => 'Portfolio Item',
            'menu_items_count' => 'Menu Item/Event',
            'properties_count' => 'Property',
            'artworks_count' => 'Artwork/Album',
            'courses_count' => 'Course',
            'programs_count' => 'Program/Event',
            'features_count' => 'Feature',
            'rooms_count' => 'Room Type/Offer',
            'treatments_count' => 'Treatment',
            'packages_count' => 'Package/Event',
            'episodes_count' => 'Episode',
            'classes_count' => 'Class/Program',
            'practice_areas_count' => 'Practice Area',
            'destinations_count' => 'Destination/Package',
            'galleries_count' => 'Gallery/Package',
            'vehicles_count' => 'Vehicle/Service'
        ];
        if (isset($businessData[$businessType])) {
            $data = $businessData[$businessType];
            $add_pages = max(0, $data['min_pages'] - 4);
            $initialTotal += $add_pages * 175;
            if ($add_pages > 0) {
                $selectedServices[] = $add_pages . ' additional page' . ($add_pages > 1 ? 's' : '') . ' ($175 each)';
            }
            foreach ($data['integrations'] as $intg) {
                $initialTotal += $intg['cost'];
                $monthlyTotal += $intg['monthly'];
                $selectedServices[] = $intg['name'];
            }
        }
        $initialTotal += 450;
        $selectedServices[] = 'Basic SEO Optimization ($450)';
        // Handle extras
        foreach ($extraLabels as $field => $label) {
            if (isset($_POST[$field])) {
                $count = max(0, (int)$_POST[$field]);
                $initialTotal += $count * 175;
                if ($count > 0) {
                    $selectedServices[] = $count . ' ' . $label . ' Pages';
                }
            }
        }
        // Handle sell
        $paymentAdded = false;
        if (isset($businessData[$businessType]) && isset($businessData[$businessType]['ask_sell']) && $businessData[$businessType]['ask_sell'] && isset($_POST['want_sell']) && $_POST['want_sell'] === 'on') {
            $initialTotal += 1000;
            $selectedServices[] = 'Payment Gateway Integration ($1000)';
            $paymentAdded = true;
        }
        // Checkboxes costs (now includes extras)
        $checkboxServices = ['domain-hosting', 'support', 'google-maps', 'multi-basic', 'performance', 'dashboards', 'speed', 'multi-pro'];
        $costs = [
            'domain-hosting' => [300, 60],
            'support' => [0, 120],
            'google-maps' => [200, 0],
            'multi-basic' => [600, 0],
            'performance' => [0, 0],
            'dashboards' => [1000, 0],
            'speed' => [350, 0],
            'multi-pro' => [1000, 0],
        ];
        foreach ($checkboxServices as $service) {
            if (isset($_POST[$service]) && $_POST[$service] === 'on') {
                $initialTotal += $costs[$service][0];
                $monthlyTotal += $costs[$service][1];
                $displayName = ucwords(str_replace('-', ' ', $service));
                if (!in_array($displayName, $selectedServices)) {
                    $selectedServices[] = $displayName;
                }
            }
        }
        // Photos radios
        if (isset($_POST['photos']) && $_POST['photos'] !== '0') {
            $photoValue = $_POST['photos'];
            $photoCosts = [
                '5' => [200, 100, 'Photos 5'],
                '10' => [300, 150, 'Photos 10'],
                '20' => [400, 200, 'Photos 20'],
            ];
            if (isset($photoCosts[$photoValue])) {
                $initialTotal += $photoCosts[$photoValue][0];
                $monthlyTotal += $photoCosts[$photoValue][1];
                $selectedServices[] = $photoCosts[$photoValue][2];
            }
        }
        // Minor changes radios
        if (isset($_POST['minor-changes'])) {
            $minorValue = $_POST['minor-changes'];
            $minorCosts = [
                'basic' => [0, 120, 'Minor Basic'],
                'standard' => [0, 200, 'Minor Standard'],
                'premium' => [0, 300, 'Minor Premium'],
            ];
            if (isset($minorCosts[$minorValue]) && $minorValue !== 'none') {
                $initialTotal += $minorCosts[$minorValue][0];
                $monthlyTotal += $minorCosts[$minorValue][1];
                $selectedServices[] = $minorCosts[$minorValue][2];
            }
        }
        // SEO upgrade
        if (isset($_POST['seo-upgrade'])) {
            $upgrade = $_POST['seo-upgrade'];
            $upgradeCosts = [
                'advanced' => [450, 'Advanced SEO Optimization ($450)'],
                'premium' => [700, 'Premium SEO Optimization ($700)']
            ];
            if (isset($upgradeCosts[$upgrade])) {
                $initialTotal += $upgradeCosts[$upgrade][0];
                $selectedServices[] = $upgradeCosts[$upgrade][1];
            }
        }
        // Dashboard
        if (isset($_POST['dashboard']) && $_POST['dashboard'] === 'yes') {
            $initialTotal += 1000;
            $selectedServices[] = 'Custom Dashboards ($1000)';
        }
        // Build email body
        $body = "Hello RenSher Team,\n\n";
        $body .= "Business Type: " . ucwords(str_replace('-', ' ', $businessType)) . "\n\n";
        $body .= "I am interested in a custom plan with the following services:\n";
        if (empty($selectedServices)) {
            $body .= "- No services selected\n";
        } else {
            foreach ($selectedServices as $service) {
                $body .= "- $service\n";
            }
        }
        $body .= "\nTotal Initial Cost: $" . number_format($initialTotal) . "\n";
        $body .= "Total Monthly Cost: $" . number_format($monthlyTotal) . "\n\n";
        $body .= "Please provide a detailed quote and next steps.\n\n";
        $body .= "Best regards,\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email";
        $to = "rensherenterprisesllc@gmail.com";
        $subject = "Custom Web Development Plan Quote Request";
        $headers = "From: hello@rensherenterprise.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        if (mail($to, $subject, $body, $headers)) {
            $alert = '<div class="alert alert-success">Message sent successfully! We\'ll email you a detailed quote within 24 hours.</div>';
        } else {
            $alert = '<div class="alert alert-danger">Error sending message. Please try again.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-256P0XXK8Q"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-256P0XXK8Q');
	</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Plan Builder</title>
    <link rel="canonical" href="https://www.rensher.com/costumize.php">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/customize.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
      .initial-text{
        align-items: center;
        justify-content: center;
        margin:1%;
        width 100%;

    }
    #text-i{margin-left:33%;}
    #heding-i{margin-left:40%;}
    
	@media screen and (max-width: 980px) {
         #text-i{margin-left:2%;}
        #heding-i{margin-left:15%;}

    }
    body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); color: #484459; }
    .step-card { transition: all 0.3s ease; background: #fff; border: solid 2px rgba(144,144,144,0.25); border-radius: 4px; box-shadow: 0 0 0.15em 0 rgba(0,0,0,0.1); padding: 1.5em; margin-bottom: 2.4em; position: relative; }
    .step-card:hover { background-color: rgba(144,144,144,0.15); transform: translateY(-2px); box-shadow: 0 0 0.15em 0 rgba(0,0,0,0.1), 0 4px 6px rgba(0,0,0,0.05); }
    .step-card.selected { background-color: rgba(16,185,129,0.1); border-color: #10b981; }
    .step-card.selected::after {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: #10b981;
        color: white;
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .progress-bar { background: linear-gradient(to right, #10b981, #34d399); }
    .total-section { background: #10b981; color: #fff; border-radius: 4px; padding: 1.5em; }
    .alert { padding: 1rem; margin-bottom: 1rem; border: solid 2px rgba(144,144,144,0.25); border-radius: 4px; }
    .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
    .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
    .service-info { display: none; position: absolute; background: #fff; border: solid 2px rgba(144,144,144,0.25); border-radius: 4px; padding: 1.5em; z-index: 10; max-width: 300px; box-shadow: 0 0 0.15em 0 rgba(0,0,0,0.1); }
    .service-info.show { display: block; }
    .monthly-toggle { display: none; margin-left: 1rem; }
    .monthly-toggle.show { display: block; }
</style>
</head>
<body class="min-h-screen">
    <!-- Header -->
    <header class=" landing is-preload bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <a href="index.html" class="text-gray-600 hover:text-gray-900 mr-4 text-lg font-semibold">Home</a>
                </div>
                <div class="text-sm text-gray-500">Step <span id="current-step">1</span> of 6</div>
            </div>
        </div>
    </header>
    <div class="initial-text">
        <h1 class="text-2xl font-bold text-gray-900 inline-block" id="heding-i">Build Your Custom Plan</h1><br>  
        <p class="text-gray-600 mt-1" id="text-i">Let's create the perfect website for your business, one step at a time!</p>  
    </div>
    
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if ($alert): ?>
            <?php echo $alert; ?>
        <?php endif; ?>
        <form method="post" action="" id="plan-form">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between mb-2">
                    <div class="flex items-center space-x-1 text-sm text-gray-500">
                        <i class="fas fa-rocket text-emerald-500"></i>
                        <span>Getting Started</span>
                    </div>
                    <div class="flex items-center space-x-1 text-sm text-gray-500">
                        <span>Almost There!</span>
                        <i class="fas fa-flag-checkered text-emerald-500"></i>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div id="progress-fill" class="progress-bar h-2 rounded-full transition-all duration-500" style="width: 16.67%"></div>
                </div>
                <div class="flex justify-between mt-2 text-xs text-gray-500">
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="text-center">
                            <div class="w-6 h-6 bg-gray-200 rounded-full mx-auto mb-1 flex items-center justify-center transition-colors <?= $i <= 1 ? 'bg-emerald-500 text-white' : '' ?>">
                                <?= $i ?>
                            </div>
                            <div>Step <?= $i ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <!-- Step 1: Initial Assessment -->
            <section id="step-1" class="step-content">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Step 1: Tell Us About Your Business</h2>
                    <p class="text-gray-600">What type of business or website purpose best describes you? This helps us tailor the essentials.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="ecommerce" class="sr-only">
                        <i class="fas fa-shopping-cart text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">E-Commerce</h3>
                        <p class="text-sm text-gray-600 mb-4">Online store with payments & inventory.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Payment Gateway</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="blog" class="sr-only">
                        <i class="fas fa-blog text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Blog/Content</h3>
                        <p class="text-sm text-gray-600 mb-4">Share articles & stories.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Blog Integration</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="portfolio" class="sr-only">
                        <i class="fas fa-images text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Portfolio</h3>
                        <p class="text-sm text-gray-600 mb-4">Showcase your work visually.</p>
                        <div class="text-xs text-emerald-600 font-medium">Prioritizes Photos</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="corporate" class="sr-only">
                        <i class="fas fa-building text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Corporate</h3>
                        <p class="text-sm text-gray-600 mb-4">Professional site for large company.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Professional Setup</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="service" class="sr-only">
                        <i class="fas fa-handshake text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Service-Based</h3>
                        <p class="text-sm text-gray-600 mb-4">Book appointments & consultations.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Dynamic Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="restaurant" class="sr-only">
                        <i class="fas fa-utensils text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Restaurant</h3>
                        <p class="text-sm text-gray-600 mb-4">Menu, reservations, and events.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="realtor" class="sr-only">
                        <i class="fas fa-home text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Realtor/Real Estate</h3>
                        <p class="text-sm text-gray-600 mb-4">Property listings and inquiries.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="news" class="sr-only">
                        <i class="fas fa-newspaper text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">News/Media</h3>
                        <p class="text-sm text-gray-600 mb-4">Publish articles and updates.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Blog</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="artist" class="sr-only">
                        <i class="fas fa-palette text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Artist/Musician</h3>
                        <p class="text-sm text-gray-600 mb-4">Showcase your art or music.</p>
                        <div class="text-xs text-emerald-600 font-medium">Prioritizes Photos</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="educational" class="sr-only">
                        <i class="fas fa-graduation-cap text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Educational</h3>
                        <p class="text-sm text-gray-600 mb-4">Online courses or school info.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="nonprofit" class="sr-only">
                        <i class="fas fa-heart text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Non-Profit/Charity</h3>
                        <p class="text-sm text-gray-600 mb-4">Promote causes and donations.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="saas" class="sr-only">
                        <i class="fas fa-cloud text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">SaaS/Software</h3>
                        <p class="text-sm text-gray-600 mb-4">Promote your software product.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ API Connection</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="hotel" class="sr-only">
                        <i class="fas fa-hotel text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Hotel/Hospitality</h3>
                        <p class="text-sm text-gray-600 mb-4">Rooms, bookings, and amenities.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="medical" class="sr-only">
                        <i class="fas fa-hospital text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Medical/Healthcare</h3>
                        <p class="text-sm text-gray-600 mb-4">Clinic services and appointments.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar & Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="financial" class="sr-only">
                        <i class="fas fa-dollar-sign text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Financial Services</h3>
                        <p class="text-sm text-gray-600 mb-4">Advisory and financial tools.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="event" class="sr-only">
                        <i class="fas fa-calendar-alt text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Event Planning</h3>
                        <p class="text-sm text-gray-600 mb-4">Conferences or weddings site.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="podcast" class="sr-only">
                        <i class="fas fa-podcast text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Podcast/Video Channel</h3>
                        <p class="text-sm text-gray-600 mb-4">Episodes and media hosting.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ API Connection</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="personal" class="sr-only">
                        <i class="fas fa-user-tie text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Personal Branding</h3>
                        <p class="text-sm text-gray-600 mb-4">Influencer or CV site.</p>
                        <div class="text-xs text-emerald-600 font-medium">Simple & Clean</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="gym" class="sr-only">
                        <i class="fas fa-dumbbell text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Gym/Fitness Center</h3>
                        <p class="text-sm text-gray-600 mb-4">Classes and membership info.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="retail" class="sr-only">
                        <i class="fas fa-store text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Retail Store</h3>
                        <p class="text-sm text-gray-600 mb-4">Physical/online hybrid store.</p>
                        <div class="text-xs text-emerald-600 font-medium">Product Focused</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="law" class="sr-only">
                        <i class="fas fa-gavel text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Law Firm/Legal Services</h3>
                        <p class="text-sm text-gray-600 mb-4">Practice areas and consultations.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="travel" class="sr-only">
                        <i class="fas fa-plane text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Travel Agency</h3>
                        <p class="text-sm text-gray-600 mb-4">Destinations and packages.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="beauty" class="sr-only">
                        <i class="fas fa-spa text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Beauty Salon/Spa</h3>
                        <p class="text-sm text-gray-600 mb-4">Services and bookings.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Calendar</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="automotive" class="sr-only">
                        <i class="fas fa-car text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Automotive</h3>
                        <p class="text-sm text-gray-600 mb-4">Car dealership or repair.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ Forms</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer">
                        <input type="radio" name="business-type" value="photography" class="sr-only">
                        <i class="fas fa-camera text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Photography Studio</h3>
                        <p class="text-sm text-gray-600 mb-4">Galleries and packages.</p>
                        <div class="text-xs text-emerald-600 font-medium">Prioritizes Photos</div>
                    </label>
                </div>
                <div id="extra-questions" style="display: none;" class="mt-6"></div>
                <div class="text-center mt-8">
                    <button type="button" onclick="nextStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-full mr-4 transition-all"><i class="fas fa-arrow-left mr-1"></i> Back</button>
                     <button type="button" onclick="nextStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold text-lg transition-all disabled:opacity-50" id="next-1" disabled> Next <i class="fas fa-arrow-right mr-1"></i></button>
   
                </div>
            </section>
            <!-- Step 2: SEO Upgrade -->
            <section id="step-2" class="step-content hidden">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Step 2: Boost Your Visibility</h2>
                    <p class="text-gray-600">Basic SEO is included. Would you like to upgrade?</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <label class="step-card p-6 cursor-pointer text-center">
                        <input type="radio" name="seo-upgrade" value="no" class="sr-only" data-initial="0">
                        <i class="fas fa-thumbs-up text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Basic SEO (Included)</h3>
                        <p class="text-sm text-gray-600">Meta tags & keywords.</p>
                        <div class="text-xs text-emerald-600 font-medium">+$0</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer text-center">
                        <input type="radio" name="seo-upgrade" value="advanced" class="sr-only" data-initial="450">
                        <i class="fas fa-bolt text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Advanced SEO</h3>
                        <p class="text-sm text-gray-600">Analysis & sitemap.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ $450</div>
                    </label>
                    <label class="step-card p-6 cursor-pointer text-center">
                        <input type="radio" name="seo-upgrade" value="premium" class="sr-only" data-initial="700">
                        <i class="fas fa-crown text-3xl text-emerald-500 mb-4"></i>
                        <h3 class="font-semibold text-gray-800 mb-2">Premium SEO</h3>
                        <p class="text-sm text-gray-600">Full audit & optimization.</p>
                        <div class="text-xs text-emerald-600 font-medium">+ $700</div>
                    </label>
                </div>
                <div class="mb-6">
                    <label class="flex items-center justify-center cursor-pointer">
                        <input type="checkbox" id="dashboard" name="dashboard" value="yes" class="mr-2" data-initial="1000" data-monthly="0">
                        <span class="text-sm font-medium text-gray-700">Add Custom Dashboard for traffic/sales insights? <i class="fas fa-info-circle text-emerald-500 ml-1" onclick="showInfo('dashboard')"></i></span>
                    </label>
                    <div id="dashboard-info" class="service-info mt-2 ml-8">
                        <strong>What:</strong> React-based panels tracking visitors & sales.<br>
                        <strong>How:</strong> Integrates with Google Analytics.<br>
                        <strong>Why:</strong> Make data-driven decisions to grow your business.
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" onclick="prevStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-full mr-4 transition-all"><i class="fas fa-arrow-left mr-1"></i> Back</button>
                    <button type="button" onclick="nextStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold text-lg transition-all disabled:opacity-50" id="next-2" disabled> Next <i class="fas fa-arrow-right mr-1"></i></button>
                </div>
            </section>
            <!-- Step 3: Photography -->
            <section id="step-3" class="step-content hidden">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Step 3: Your Visuals</h2>
                    <p class="text-gray-600">Can you provide high-quality photos? Or need professional ones?</p>
                </div>
                <div class="space-y-4 max-w-md mx-auto">
                    <label class="step-card flex items-center p-4 cursor-pointer">
                        <input type="radio" name="photos" value="0" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="0" data-monthly="0">
                        <span class="text-sm font-medium">I'll provide my own photos</span>
                    </label>
                    <label class="step-card flex items-center p-4 cursor-pointer">
                        <input type="radio" name="photos" value="5" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="200" data-monthly="0">
                        <span class="text-sm font-medium">Need 5 professional photos ($200 initial)</span>
                    </label>
                    <label class="step-card flex items-center p-4 cursor-pointer">
                        <input type="radio" name="photos" value="10" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="300" data-monthly="0">
                        <span class="text-sm font-medium">Need 10 professional photos ($300 initial)</span>
                    </label>
                    <label class="step-card flex items-center p-4 cursor-pointer">
                        <input type="radio" name="photos" value="20" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="400" data-monthly="0">
                        <span class="text-sm font-medium">Need 20 professional photos ($400 initial)</span>
                    </label>
                </div>
                <div class="text-center mt-8">
                    <button type="button" onclick="prevStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-full mr-4 transition-all"><i class="fas fa-arrow-left mr-1"></i> Back</button>
                   <button type="button" onclick="nextStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold text-lg transition-all disabled:opacity-50" id="next-3" disabled> Next <i class="fas fa-arrow-right mr-1"></i></button>
                </div>
            </section>
            <!-- Step 4: Hosting, Domain, Maintenance -->
            <section id="step-4" class="step-content hidden">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Step 4: Keep It Running Smoothly</h2>
                    <p class="text-gray-600">Need us to handle hosting, domain, and ongoing maintenance?</p>
                </div>
                <div class="max-w-md mx-auto space-y-4">
                    <label class="step-card flex items-center p-4 cursor-pointer">
                        <input type="checkbox" name="domain-hosting" class="form-checkbox h-4 w-4 text-emerald-600 mr-3" data-initial="300" data-monthly="60">
                        <span class="text-sm font-medium">Domain & Hosting Setup <i class="fas fa-info-circle text-emerald-500 ml-1" onclick="showInfo('domain-hosting')"></i></span>
                        <div class="ml-auto text-xs text-gray-500">Initial: $300 | Monthly: $60</div>
                    </label>
                    <div id="domain-hosting-info" class="service-info mt-2 ml-12">
                        <strong>What:</strong> Secure domain registration & reliable hosting.<br>
                        <strong>How:</strong> 99.9% uptime with managed setup.<br>
                        <strong>Why:</strong> Focus on your business, not tech headaches.
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maintenance Level (Ongoing Updates)</label>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="minor-changes" value="none" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="0" data-monthly="0">
                                <span class="text-sm">None</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="minor-changes" value="basic" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="0" data-monthly="120">
                                <span class="text-sm">Basic (15 changes/mo) $120/mo</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="minor-changes" value="standard" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="0" data-monthly="200">
                                <span class="text-sm">Standard (25 changes/mo) $200/mo</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="minor-changes" value="premium" class="form-radio h-4 w-4 text-emerald-600 mr-3" data-initial="0" data-monthly="300">
                                <span class="text-sm">Premium (45 changes/mo) $300/mo</span>
                            </label>
                        </div>
                    </div>
                    <label class="step-card flex items-center p-4 cursor-pointer">
                        <input type="checkbox" name="support" class="form-checkbox h-4 w-4 text-emerald-600 mr-3" data-initial="0" data-monthly="120">
                        <span class="text-sm font-medium">24/7 Technical Support <i class="fas fa-info-circle text-emerald-500 ml-1" onclick="showInfo('support')"></i></span>
                        <div class="ml-auto text-xs text-gray-500">Monthly: $120</div>
                    </label>
                    <div id="support-info" class="service-info mt-2 ml-12">
                        <strong>What:</strong> Round-the-clock help desk.<br>
                        <strong>How:</strong> Response within 24 hours via email/ticket.<br>
                        <strong>Why:</strong> Peace of mind – your site never goes down alone.
                    </div>
                </div>
                <div class="text-center mt-8">
                    <button type="button" onclick="prevStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-full mr-4 transition-all"><i class="fas fa-arrow-left mr-1"></i> Back</button>
                    <button type="button" onclick="nextStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold text-lg transition-all disabled:opacity-50" id="next-4" disabled> Next <i class="fas fa-arrow-right mr-1"></i></button>
   
                </div>
            </section>
            <!-- Step 5: Google Maps -->
            <section id="step-5" class="step-content hidden">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Step 5: Local Presence</h2>
                    <p class="text-gray-600">Do you have a physical location customers should find easily?</p>
                </div>
                <div class="max-w-md mx-auto space-y-4">
                    <label class="step-card flex items-center justify-center p-6 cursor-pointer text-lg">
                        <input type="checkbox" name="google-maps" class="form-checkbox h-5 w-5 text-emerald-600 mr-3" data-initial="200" data-monthly="0">
                        <span class="font-semibold">Yes, add Google Maps & Business Profile <i class="fas fa-info-circle text-emerald-500 ml-2" onclick="showInfo('google-maps')"></i></span>
                        <div class="text-xs text-emerald-600 mt-2">Initial: $200</div>
                    </label>
                    <div id="google-maps-info" class="service-info mx-auto mt-2">
                        <strong>What:</strong> Google Business setup with maps integration.<br>
                        <strong>How:</strong> Verified listing for local searches.<br>
                        <strong>Why:</strong> Attract nearby customers – 46% of searches are local!
                    </div>
                    <label class="step-card flex items-center justify-center p-6 cursor-pointer text-lg opacity-50">
                        <input type="checkbox" name="google-maps" class="form-checkbox h-5 w-5 text-emerald-600 mr-3" data-initial="0" data-monthly="0" disabled>
                        <span class="font-semibold text-gray-500">No physical location needed</span>
                    </label>
                </div>
                <div class="text-center mt-8">
                    <button type="button" onclick="prevStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-full mr-4 transition-all"><i class="fas fa-arrow-left mr-1"></i> Back</button>
                    <button type="button" onclick="nextStep()" class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-full font-semibold text-lg transition-all">Review & Submit</button>
                 
                </div>
            </section>
            <!-- Step 6: Review and Submit -->
            <section id="step-6" class="step-content hidden">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Step 6: Review Your Plan</h2>
                    <p class="text-gray-600">Almost done! Toggle services, learn more, and get your quote.</p>
                </div>
                <!-- Totals Section -->
                <section class="total-section text-white p-6 mb-8 text-center">
                    <h3 class="text-xl font-bold mb-4">Your Tailored Plan</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm opacity-90">Initial Cost:</p>
                            <p id="initial-total" class="text-2xl font-bold">$1,400</p> <!-- Base starts here -->
                        </div>
                        <div>
                            <p class="text-sm opacity-90">Monthly Cost:</p>
                            <p id="monthly-total" class="text-2xl font-bold">$0</p>
                        </div>
                    </div>
                    <div id="selected-services" class="text-sm opacity-90">
                        <p><strong>Selected Services:</strong></p>
                        <ul id="services-list" class="list-disc list-inside mt-2"></ul>
                    </div>
                </section>
                <!-- Contact Info -->
                <section class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Contact Details</h3>
                    <p class="text-center text-gray-600 mb-4">Enter your info to receive the quote.</p>
                    <div class="grid grid-cols-1 gap-4 max-w-md mx-auto">
                        <div class="flex items-center space-x-2">
                            <label for="user-name" class="text-sm font-medium text-gray-700 min-w-0 flex-shrink-0">Name</label>
                            <input type="text" id="user-name" name="name" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                        </div>
                        <div class="flex items-center space-x-2">
                            <label for="user-email" class="text-sm font-medium text-gray-700 min-w-0 flex-shrink-0">Email</label>
                            <input type="email" id="user-email" name="email" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                        </div>
                    </div>
                </section>
                <!-- Services Review (All toggleable) -->
                <div class="space-y-4 mb-8">
                    <!-- Dynamic services list will be populated by JS -->
                    <div id="review-services"></div>
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="prevStep()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-full transition-all"><i class="fas fa-arrow-left mr-1"></i> Back</button>
                    <input type="submit" id="send-plan" class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-full font-semibold text-lg transition-all disabled:opacity-50" value="Send Quote Request" disabled>
                </div>
            </section>
        </form>
    </main>
    <script>
        let currentStep = 1;
        let initialTotal = 1400; // Base custom dev
        let monthlyTotal = 0;
        let selectedServices = ['100% Custom Web Development ($1400 for 4 pages)'];
        let extras = {};
        const steps = 6;
        const businessTypes = {
            'ecommerce': {
                icon: 'fa-shopping-cart',
                title: 'E-Commerce',
                desc: 'Online store with payments & inventory.',
                min_pages: 5,
                integrations: [{cost:1000, monthly:0, name:'Payment Gateway Integration ($1000)'}],
                extra_type: {field: 'products_count', label: 'Product'},
                ask_sell: false
            },
            'blog': {
                icon: 'fa-blog',
                title: 'Blog/Content',
                desc: 'Share articles & stories.',
                min_pages: 4,
                integrations: [{cost:450, monthly:0, name:'Blog Integration ($450)'}],
                extra_type: null,
                ask_sell: true
            },
            'portfolio': {
                icon: 'fa-images',
                title: 'Portfolio',
                desc: 'Showcase your work visually.',
                min_pages: 4,
                integrations: [],
                extra_type: {field: 'portfolio_items_count', label: 'Portfolio Item'},
                ask_sell: false
            },
            'corporate': {
                icon: 'fa-building',
                title: 'Corporate',
                desc: 'Professional site for large company.',
                min_pages: 6,
                integrations: [],
                extra_type: {field: 'services_count', label: 'Service/Product'},
                ask_sell: true
            },
            'service': {
                icon: 'fa-handshake',
                title: 'Service-Based',
                desc: 'Book appointments & consultations.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'services_count', label: 'Service'},
                ask_sell: true
            },
            'restaurant': {
                icon: 'fa-utensils',
                title: 'Restaurant',
                desc: 'Menu, reservations, and events.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Calendar Integration ($400)'}],
                extra_type: {field: 'menu_items_count', label: 'Menu Item/Event'},
                ask_sell: false
            },
            'realtor': {
                icon: 'fa-home',
                title: 'Realtor/Real Estate',
                desc: 'Property listings and inquiries.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'properties_count', label: 'Property'},
                ask_sell: false
            },
            'news': {
                icon: 'fa-newspaper',
                title: 'News/Media',
                desc: 'Publish articles and updates.',
                min_pages: 5,
                integrations: [{cost:450, monthly:0, name:'Blog Integration ($450)'}],
                extra_type: null,
                ask_sell: true
            },
            'artist': {
                icon: 'fa-palette',
                title: 'Artist/Musician',
                desc: 'Showcase your art or music.',
                min_pages: 5,
                integrations: [],
                extra_type: {field: 'artworks_count', label: 'Artwork/Album'},
                ask_sell: false
            },
            'educational': {
                icon: 'fa-graduation-cap',
                title: 'Educational',
                desc: 'Online courses or school info.',
                min_pages: 6,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'courses_count', label: 'Course'},
                ask_sell: false
            },
            'nonprofit': {
                icon: 'fa-heart',
                title: 'Non-Profit/Charity',
                desc: 'Promote causes and donations.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'programs_count', label: 'Program/Event'},
                ask_sell: false
            },
            'saas': {
                icon: 'fa-cloud',
                title: 'SaaS/Software',
                desc: 'Promote your software product.',
                min_pages: 6,
                integrations: [{cost:200, monthly:0, name:'External API Connection ($200)'}],
                extra_type: {field: 'features_count', label: 'Feature'},
                ask_sell: false
            },
            'hotel': {
                icon: 'fa-hotel',
                title: 'Hotel/Hospitality',
                desc: 'Rooms, bookings, and amenities.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Calendar Integration ($400)'}],
                extra_type: {field: 'rooms_count', label: 'Room Type/Offer'},
                ask_sell: false
            },
            'medical': {
                icon: 'fa-hospital',
                title: 'Medical/Healthcare',
                desc: 'Clinic services and appointments.',
                min_pages: 6,
                integrations: [
                    {cost:400, monthly:0, name:'Calendar Integration ($400)'},
                    {cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}
                ],
                extra_type: {field: 'treatments_count', label: 'Treatment'},
                ask_sell: false
            },
            'financial': {
                icon: 'fa-dollar-sign',
                title: 'Financial Services',
                desc: 'Advisory and financial tools.',
                min_pages: 6,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'services_count', label: 'Service/Product'},
                ask_sell: true
            },
            'event': {
                icon: 'fa-calendar-alt',
                title: 'Event Planning',
                desc: 'Conferences or weddings site.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Calendar Integration ($400)'}],
                extra_type: {field: 'packages_count', label: 'Package/Event'},
                ask_sell: false
            },
            'podcast': {
                icon: 'fa-podcast',
                title: 'Podcast/Video Channel',
                desc: 'Episodes and media hosting.',
                min_pages: 5,
                integrations: [{cost:200, monthly:0, name:'External API Connection ($200)'}],
                extra_type: {field: 'episodes_count', label: 'Episode'},
                ask_sell: false
            },
            'personal': {
                icon: 'fa-user-tie',
                title: 'Personal Branding',
                desc: 'Influencer or CV site.',
                min_pages: 4,
                integrations: [],
                extra_type: null,
                ask_sell: true
            },
            'gym': {
                icon: 'fa-dumbbell',
                title: 'Gym/Fitness Center',
                desc: 'Classes and membership info.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Calendar Integration ($400)'}],
                extra_type: {field: 'classes_count', label: 'Class/Program'},
                ask_sell: false
            },
            'retail': {
                icon: 'fa-store',
                title: 'Retail Store',
                desc: 'Physical/online hybrid store.',
                min_pages: 5,
                integrations: [],
                extra_type: {field: 'products_count', label: 'Product'},
                ask_sell: true
            },
            'law': {
                icon: 'fa-gavel',
                title: 'Law Firm/Legal Services',
                desc: 'Practice areas and consultations.',
                min_pages: 6,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'practice_areas_count', label: 'Practice Area'},
                ask_sell: false
            },
            'travel': {
                icon: 'fa-plane',
                title: 'Travel Agency',
                desc: 'Destinations and packages.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Calendar Integration ($400)'}],
                extra_type: {field: 'destinations_count', label: 'Destination/Package'},
                ask_sell: false
            },
            'beauty': {
                icon: 'fa-spa',
                title: 'Beauty Salon/Spa',
                desc: 'Services and bookings.',
                min_pages: 5,
                integrations: [{cost:400, monthly:0, name:'Calendar Integration ($400)'}],
                extra_type: {field: 'services_count', label: 'Service'},
                ask_sell: true
            },
            'automotive': {
                icon: 'fa-car',
                title: 'Automotive',
                desc: 'Car dealership or repair.',
                min_pages: 6,
                integrations: [{cost:400, monthly:0, name:'Dynamic Forms Integration ($400)'}],
                extra_type: {field: 'vehicles_count', label: 'Vehicle/Service'},
                ask_sell: true
            },
            'photography': {
                icon: 'fa-camera',
                title: 'Photography Studio',
                desc: 'Galleries and packages.',
                min_pages: 5,
                integrations: [],
                extra_type: {field: 'galleries_count', label: 'Gallery/Package'},
                ask_sell: false
            }
        };
        // Update progress
        function updateProgress() {
            const progress = (currentStep / steps) * 100;
            document.getElementById('progress-fill').style.width = progress + '%';
            document.getElementById('current-step').textContent = currentStep;
            for (let i = 1; i <= steps; i++) {
                const circle = document.querySelector(`div:nth-child(${i}) > div.w-6`);
                if (i <= currentStep) {
                    circle.classList.remove('bg-gray-200', 'text-gray-800');
                    circle.classList.add('bg-emerald-500', 'text-white');
                } else {
                    circle.classList.remove('bg-emerald-500', 'text-white');
                    circle.classList.add('bg-gray-200', 'text-gray-800');
                }
            }
        }
        // Next/Prev Step
        function nextStep() {
            if (currentStep < steps) {
                document.getElementById(`step-${currentStep}`).classList.add('hidden');
                currentStep++;
                document.getElementById(`step-${currentStep}`).classList.remove('hidden');
                updateProgress();
                if (currentStep === 6) populateReview();
            }
        }
        function prevStep() {
            if (currentStep > 1) {
                document.getElementById(`step-${currentStep}`).classList.add('hidden');
                currentStep--;
                document.getElementById(`step-${currentStep}`).classList.remove('hidden');
                updateProgress();
            }
        }
        // Update Totals
        function updateTotals() {
            document.getElementById('initial-total').textContent = `$${initialTotal.toLocaleString()}`;
            document.getElementById('monthly-total').textContent = `$${monthlyTotal.toLocaleString()}`;
            const servicesList = document.getElementById('services-list');
            servicesList.innerHTML = selectedServices.map(s => `<li>${s}</li>`).join('');
        }
        // Enable Next Button
        function enableNext(stepNum) {
            const btn = document.getElementById(`next-${stepNum}`);
            if (btn) btn.disabled = false;
        }
        // Show Info
        function showInfo(id) {
            const info = document.getElementById(id + '-info');
            info.classList.toggle('show');
        }
        // Visual Selection Feedback
       // Visual Selection Feedback (Mejorado para radios)
        document.addEventListener('change', function(e) {
            if (e.target.type === 'radio') {
                // Para radios: actualiza TODOS los labels del mismo grupo (name)
                const radioName = e.target.name;
                const allRadios = document.querySelectorAll(`input[type="radio"][name="${radioName}"]`);
                
                allRadios.forEach(radio => {
                    const label = radio.closest('label.step-card');
                    if (label) {
                        if (radio.checked) {
                            label.classList.add('selected');
                        } else {
                            label.classList.remove('selected');
                        }
                    }
                });
            } else if (e.target.type === 'checkbox') {
                // Para checkboxes (comportamiento original)
                const label = e.target.closest('label.step-card');
                if (label) {
                    if (e.target.checked) {
                        label.classList.add('selected');
                    } else {
                        label.classList.remove('selected');
                    }
                }
            }
        });
        // Step 1 Listeners
        document.querySelectorAll('input[name="business-type"]').forEach(input => {
            input.addEventListener('change', (e) => {
                const type = e.target.value;
                const typeData = businessTypes[type];
                if (!typeData) return;
                // Reset
                initialTotal = 1400;
                monthlyTotal = 0;
                selectedServices = ['100% Custom Web Development ($1400 for 4 pages)'];
                extras = {};
                // Additional base pages
                const add_pages = Math.max(0, typeData.min_pages - 4);
                if (add_pages > 0) {
                    initialTotal += add_pages * 175;
                    selectedServices.push(add_pages + ' additional page' + (add_pages > 1 ? 's' : '') + ' ($175 each)');
                }
                // Integrations
                typeData.integrations.forEach(intg => {
                    initialTotal += intg.cost;
                    monthlyTotal += intg.monthly;
                    selectedServices.push(intg.name);
                });
                // Basic SEO
                initialTotal += 450;
                selectedServices.push('Basic SEO Optimization ($450)');
                updateTotals();
                // Extra questions
                const extraDiv = document.getElementById('extra-questions');
                extraDiv.innerHTML = '';
                let hasExtra = false;
                if (typeData.extra_type) {
                    const et = typeData.extra_type;
                    const div = document.createElement('div');
                    div.className = 'p-4 bg-white rounded-lg shadow-sm';
                    div.innerHTML = `
                        <h4 class="font-semibold mb-2">Additional Pages</h4>
                        <p class="text-sm text-gray-600 mb-2">How many ${et.label.toLowerCase()} do you plan to feature? Each adds a dedicated page at $175.</p>
                        <input type="number" name="${et.field}" min="0" value="0" class="px-3 py-2 border border-gray-300 rounded-md w-full" oninput="updateExtra('${et.field}', '${et.label}', 175)">
                    `;
                    extraDiv.appendChild(div);
                    hasExtra = true;
                }
                if (typeData.ask_sell) {
                    const div = document.createElement('div');
                    div.className = 'p-4 bg-white rounded-lg shadow-sm mt-4';
                    div.innerHTML = `
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="want_sell" class="h-4 w-4 text-emerald-600 mr-2" onchange="updateSell(this, '${type}')">
                            <span class="text-sm font-medium">Do you want to sell products online? (Adds Payment Gateway $1000 + $175 per product page)</span>
                        </label>
                    `;
                    extraDiv.appendChild(div);
                    hasExtra = true;
                }
                extraDiv.style.display = hasExtra ? 'block' : 'none';
                enableNext(1);
            });
        });
        // Update Extra
        function updateExtra(field, label, cost) {
            const input = document.querySelector(`input[name="${field}"]`);
            if (!input) return;
            const now = parseInt(input.value) || 0;
            const prev = extras[field] || 0;
            initialTotal += (now - prev) * cost;
            extras[field] = now;
            selectedServices = selectedServices.filter(s => !s.includes(label + ' Pages'));
            if (now > 0) {
                selectedServices.push(`${now} ${label} Pages`);
            }
            updateTotals();
        }
        // Update Sell
        function updateSell(cb, type) {
            const checked = cb.checked;
            const paymentName = 'Payment Gateway Integration ($1000)';
            if (checked) {
                if (!selectedServices.includes(paymentName)) {
                    initialTotal += 1000;
                    selectedServices.push(paymentName);
                }
                if (!document.querySelector('input[name="products_count"]')) {
                    const sellDiv = cb.closest('div');
                    const prodDiv = document.createElement('div');
                    prodDiv.className = 'mt-4 p-4 bg-gray-50 rounded';
                    prodDiv.innerHTML = `
                        <h5 class="font-medium mb-2">Product Pages</h5>
                        <p class="text-sm text-gray-600 mb-2">How many products? Each $175 page.</p>
                        <input type="number" name="products_count" min="0" value="0" class="px-3 py-2 border rounded-md w-full" oninput="updateExtra('products_count', 'Product', 175)">
                    `;
                    sellDiv.appendChild(prodDiv);
                }
            } else {
                initialTotal -= 1000;
                selectedServices = selectedServices.filter(s => s === paymentName);
                const prodInput = document.querySelector('input[name="products_count"]');
                if (prodInput) {
                    const prodDiv = prodInput.closest('div');
                    const isMainExtra = businessTypes[type] && businessTypes[type].extra_type && businessTypes[type].extra_type.field === 'products_count';
                    if (!isMainExtra) {
                        const count = extras['products_count'] || 0;
                        initialTotal -= count * 175;
                        delete extras['products_count'];
                        selectedServices = selectedServices.filter(s => !s.includes('Product Pages'));
                        if (prodDiv) prodDiv.remove();
                    }
                }
            }
            updateTotals();
        }
        // Step 2 Listeners
        document.querySelectorAll('input[name="seo-upgrade"]').forEach(input => {
            input.addEventListener('change', (e) => {
                const upgrade = e.target.value;
                const addCost = parseInt(e.target.dataset.initial) || 0;
                let upgradeName = '';
                if (upgrade === 'advanced') {
                    upgradeName = 'Advanced SEO Optimization ($450)';
                } else if (upgrade === 'premium') {
                    upgradeName = 'Premium SEO Optimization ($700)';
                }
                initialTotal += addCost;
                if (addCost > 0 && !selectedServices.includes(upgradeName)) {
                    selectedServices.push(upgradeName);
                }
                updateTotals();
                enableNext(2);
            });
        });
        document.getElementById('dashboard').addEventListener('change', (e) => {
            if (e.target.checked) {
                initialTotal += 1000;
                selectedServices.push('Custom Dashboards ($1000)');
            } else {
                initialTotal -= 1000;
                selectedServices = selectedServices.filter(s => s !== 'Custom Dashboards ($1000)');
            }
            updateTotals();
        });
        // Step 3 Listeners
        document.querySelectorAll('input[name="photos"]').forEach(input => {
            input.addEventListener('change', (e) => {
                const val = e.target.value;
                const photoCosts = { '5': [200, 100], '10': [300, 150], '20': [400, 200] };
                if (val !== '0') {
                    initialTotal += photoCosts[val][0];
                    monthlyTotal += photoCosts[val][1];
                    selectedServices.push('Photos ' + val);
                }
                updateTotals();
                enableNext(3);
            });
        });
        // Step 4 Listeners
        ['domain-hosting', 'support'].forEach(id => {
            const input = document.querySelector(`input[name="${id}"]`);
            input.addEventListener('change', (e) => {
                const init = parseFloat(e.target.dataset.initial) || 0;
                const mo = parseFloat(e.target.dataset.monthly) || 0;
                if (e.target.checked) {
                    initialTotal += init;
                    monthlyTotal += mo;
                    selectedServices.push(ucwords(id.replace('-', ' ')));
                } else {
                    initialTotal -= init;
                    monthlyTotal -= mo;
                    selectedServices = selectedServices.filter(s => !s.includes(ucwords(id.replace('-', ' '))));
                }
                updateTotals();
            });
        });
        document.querySelectorAll('input[name="minor-changes"]').forEach(input => {
            input.addEventListener('change', (e) => {
                const val = e.target.value;
                const minorCosts = { basic: 120, standard: 200, premium: 300 };
                if (val !== 'none') {
                    monthlyTotal += minorCosts[val];
                    selectedServices.push('Minor Changes ' + ucwords(val));
                }
                updateTotals();
                enableNext(4);
            });
        });
        // Step 5 Listener
        document.querySelector('input[name="google-maps"]').addEventListener('change', (e) => {
            if (e.target.checked) {
                initialTotal += 200;
                selectedServices.push('Google Maps');
            } else {
                initialTotal -= 200;
                selectedServices = selectedServices.filter(s => s !== 'Google Maps');
            }
            updateTotals();
            nextStep(); // Auto next since simple
        });

        // Step 6: Contact Validation
        ['user-name', 'user-email'].forEach(id => {
            document.getElementById(id).addEventListener('input', () => {
                const name = document.getElementById('user-name').value.trim();
                const email = document.getElementById('user-email').value.trim();
                document.getElementById('send-plan').disabled = !(name && email && selectedServices.length > 1);
            });
        });
        // Populate Review Services
        function populateReview() {
            const reviewDiv = document.getElementById('review-services');
            const allServices = [
                { id: 'speed', name: 'Advanced Speed Optimization ($350)', initial: 350, monthly: 0, info: 'Lazy loading & CDN for fast loads.' },
                { id: 'multi-basic', name: 'Basic Multilingual ($600)', initial: 600, monthly: 0, info: 'Support 2 languages.' },
                { id: 'performance', name: 'Monthly Performance Analysis', initial: 0, monthly: 0, info: 'Free Google Analytics reports.' },
                { id: 'multi-pro', name: 'Pro Multilingual ($1000)', initial: 1000, monthly: 0, info: 'Unlimited languages.' }
            ];
            reviewDiv.innerHTML = allServices.map(service => `
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <label class="flex items-center cursor-pointer flex-1">
                        <input type="checkbox" name="${service.id}" class="form-checkbox h-4 w-4 text-emerald-600 mr-3" data-initial="${service.initial}" data-monthly="${service.monthly}" ${selectedServices.includes(service.name) ? 'checked' : ''}>
                        <span class="text-sm font-medium">${service.name} <i class="fas fa-info-circle text-emerald-500 ml-1" onclick="showInfo('${service.id}')"></i></span>
                    </label>
                    <div class="text-xs text-gray-500 ml-4">$${service.initial} / $${service.monthly}/mo</div>
                </div>
                <div id="${service.id}-info" class="service-info mt-2 ml-20">
                    <strong>What:</strong> ${service.info}<br>
                    <strong>How:</strong> Integrated seamlessly.<br>
                    <strong>Why:</strong> Enhances user experience & growth.
                </div>
            `).join('');
            reviewDiv.querySelectorAll('input[type="checkbox"]').forEach(input => {
                input.addEventListener('change', (e) => {
                    const serviceName = input.parentElement.querySelector('span').textContent.trim().replace(/ \+.*$/, '');
                    const init = parseFloat(e.target.dataset.initial) || 0;
                    const mo = parseFloat(e.target.dataset.monthly) || 0;
                    if (e.target.checked) {
                        initialTotal += init;
                        monthlyTotal += mo;
                        selectedServices.push(serviceName);
                    } else {
                        initialTotal -= init;
                        monthlyTotal -= mo;
                        selectedServices = selectedServices.filter(s => s !== serviceName);
                    }
                    updateTotals();
                });
            });
            updateTotals();
        }
        function ucwords(str) {
            return str.replace(/\b\w/g, l => l.toUpperCase());
        }
        updateProgress();
    </script>
</body>
</html>