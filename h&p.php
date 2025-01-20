<?php
// help_support.php

// Sample help and support materials
$helpMaterials = [
    [
        'title' => 'Getting Started',
        'description' => 'A guide to help you get started with our services.',
        'link' => 'getting_started.php'
    ],
    [
        'title' => 'FAQ',
        'description' => 'Frequently Asked Questions about our services.',
        'link' => 'faq.php'
    ],
    [
        'title' => 'Contact Support',
        'description' => 'Reach out to our support team for assistance.',
        'link' => 'contact_support.php'
    ],
    [
        'title' => 'User  Manual',
        'description' => 'Comprehensive user manual for our application.',
        'link' => 'user_manual.php'
    ],
    [
        'title' => 'Troubleshooting Guide',
        'description' => 'Common issues and how to resolve them.',
        'link' => 'troubleshooting.php'
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support</title>
    <link rel="stylesheet" href="styles2.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Help & Support</h1>
    </header>
    <main>
        <section>
            <h2>Available Resources</h2>
            <ul>
                <?php foreach ($helpMaterials as $material): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($material['title']); ?></h3>
                        <p><?php echo htmlspecialchars($material['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($material['link']); ?>">Learn More</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Local-Hand. All rights reserved.</p>
    </footer>
</body>
</html>