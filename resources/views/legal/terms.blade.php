<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service — Invento Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900">Invento Track</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-900">← Back to home</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-16">
        <div class="bg-white rounded-2xl border border-gray-200 p-8 md:p-12 shadow-sm">

            <div class="mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-3">Terms of Service</h1>
                <p class="text-gray-500 text-sm">Last updated: {{ date('F d, Y') }} · Effective: {{ date('F d, Y') }}</p>
                <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <p class="text-amber-800 text-sm font-medium">Please read these Terms of Service carefully before using Invento Track. By accessing or using our Service, you agree to be bound by these terms.</p>
                </div>
            </div>

            <div class="space-y-8 text-sm leading-relaxed text-gray-600">

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">1. Agreement to Terms</h2>
                    <p>These Terms of Service ("Terms") constitute a legally binding agreement between you ("User", "you", or "your") and Invento Track ("Company", "we", "us", or "our"), governing your access to and use of the Invento Track inventory management platform and related services (the "Service").</p>
                    <p class="mt-3">By creating an account, accessing, or using the Service, you confirm that you are at least 18 years old, have the legal authority to enter into this agreement, and agree to be bound by these Terms and our Privacy Policy.</p>
                    <p class="mt-3">If you are using the Service on behalf of a company or organization, you represent that you have the authority to bind that entity to these Terms.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">2. Description of Service</h2>
                    <p>Invento Track is a cloud-based, multi-tenant Software-as-a-Service (SaaS) inventory management platform that allows businesses to:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2 mt-3">
                        <li>Track product inventory across multiple warehouse locations</li>
                        <li>Manage stock movements (stock in, stock out, adjustments)</li>
                        <li>Create and manage purchase orders from suppliers</li>
                        <li>Process sales orders and generate invoices</li>
                        <li>Record customer payments and track outstanding balances</li>
                        <li>Manage product catalogues, categories, and units of measurement</li>
                        <li>Access reports and receive low-stock alerts</li>
                    </ul>
                    <p class="mt-3">We reserve the right to modify, suspend, or discontinue any aspect of the Service at any time with reasonable notice.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">3. Account Registration and Security</h2>
                    <p>To use the Service, you must register for an account. You agree to:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li>Provide accurate, current, and complete information during registration</li>
                        <li>Maintain and promptly update your account information</li>
                        <li>Keep your password secure and confidential</li>
                        <li>Notify us immediately of any unauthorized access to your account</li>
                        <li>Be responsible for all activity that occurs under your account</li>
                        <li>Not share your account credentials with unauthorized persons</li>
                    </ul>
                    <p class="mt-3">We reserve the right to suspend or terminate accounts that violate these Terms, provide false information, or engage in fraudulent activity.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">4. Subscription Plans and Payment</h2>

                    <p class="font-semibold text-gray-700 mb-2">4.1 Free Trial</p>
                    <p>New accounts receive a 14-day free trial with access to all features of the selected plan. No credit card is required for the trial. At the end of the trial period, you must upgrade to a paid plan to continue using the Service.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">4.2 Paid Subscriptions</p>
                    <p>Paid subscriptions are billed monthly or annually in advance. By subscribing, you authorize us to charge your payment method on a recurring basis. All fees are non-refundable except as required by law.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">4.3 Plan Limits</p>
                    <p>Each subscription plan has limits on the number of users, products, and warehouse locations. Exceeding these limits may result in restricted access until you upgrade your plan.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">4.4 Price Changes</p>
                    <p>We reserve the right to change subscription prices with at least 30 days' notice. Your continued use of the Service after a price change constitutes acceptance of the new pricing.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">4.5 Cancellation</p>
                    <p>You may cancel your subscription at any time through your account settings. Cancellation takes effect at the end of your current billing period. You will retain access to the Service until that date.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">5. Acceptable Use Policy</h2>
                    <p>You agree to use the Service only for lawful purposes and in accordance with these Terms. You must NOT:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li>Use the Service for any illegal or fraudulent purpose</li>
                        <li>Attempt to gain unauthorized access to any part of the Service or other users' accounts</li>
                        <li>Reverse engineer, decompile, or disassemble any part of the Service</li>
                        <li>Upload viruses, malware, or any other malicious code</li>
                        <li>Use automated tools to scrape, crawl, or extract data from the Service without permission</li>
                        <li>Resell or sublicense access to the Service without our written consent</li>
                        <li>Use the Service to store or transmit illegal content</li>
                        <li>Interfere with or disrupt the integrity or performance of the Service</li>
                        <li>Impersonate any person or entity</li>
                    </ul>
                    <p class="mt-3">Violation of this Acceptable Use Policy may result in immediate termination of your account without refund.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">6. Your Data and Content</h2>
                    <p class="font-semibold text-gray-700 mb-2">6.1 Ownership</p>
                    <p>You retain full ownership of all data and content you upload or create within the Service ("Your Content"), including your product catalogues, customer records, financial data, and business information.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">6.2 License to Us</p>
                    <p>By using the Service, you grant us a limited, non-exclusive license to store, process, and display Your Content solely for the purpose of providing the Service to you.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">6.3 Data Accuracy</p>
                    <p>You are solely responsible for the accuracy, legality, and completeness of Your Content. We are not responsible for any errors or inaccuracies in data you enter.</p>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">6.4 Data Export</p>
                    <p>You may export your data at any time while your account is active. We recommend maintaining your own backups of critical business data.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">7. Intellectual Property</h2>
                    <p>The Service, including its software, design, text, graphics, logos, and other content (excluding Your Content), is owned by Invento Track and protected by copyright, trademark, and other intellectual property laws.</p>
                    <p class="mt-3">We grant you a limited, non-exclusive, non-transferable license to access and use the Service for your internal business purposes in accordance with these Terms. This license does not include any right to resell the Service or create derivative works.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">8. Service Availability and Uptime</h2>
                    <p>We strive to maintain 99.9% uptime for the Service. However, we do not guarantee uninterrupted availability. The Service may be temporarily unavailable due to:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2 mt-3">
                        <li>Scheduled maintenance (we will provide advance notice where possible)</li>
                        <li>Emergency maintenance or security patches</li>
                        <li>Events beyond our reasonable control (force majeure)</li>
                        <li>Third-party service provider outages</li>
                    </ul>
                    <p class="mt-3">We are not liable for any loss or damage caused by Service unavailability.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">9. Disclaimer of Warranties</h2>
                    <p class="uppercase font-semibold text-gray-700 text-xs mb-3">Important — Please Read Carefully</p>
                    <p>THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT.</p>
                    <p class="mt-3">We do not warrant that the Service will be error-free, that defects will be corrected, or that the Service is free of viruses or other harmful components. We do not warrant the accuracy, completeness, or usefulness of any information provided through the Service.</p>
                    <p class="mt-3">The Service is designed to assist with inventory management. It is not a substitute for professional accounting, legal, or financial advice. You are responsible for ensuring compliance with all applicable laws and regulations in your jurisdiction.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">10. Limitation of Liability</h2>
                    <p>TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, INVENTO TRACK SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2 mt-3">
                        <li>Loss of profits, revenue, or business</li>
                        <li>Loss of data or business information</li>
                        <li>Business interruption</li>
                        <li>Loss of goodwill</li>
                        <li>Any other commercial damages or losses</li>
                    </ul>
                    <p class="mt-3">Our total liability to you for any claims arising from these Terms or your use of the Service shall not exceed the total amount paid by you to us in the 12 months preceding the claim.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">11. Indemnification</h2>
                    <p>You agree to indemnify, defend, and hold harmless Invento Track and its officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, and expenses (including legal fees) arising out of or in connection with:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2 mt-3">
                        <li>Your violation of these Terms</li>
                        <li>Your use of the Service</li>
                        <li>Your violation of any third-party rights</li>
                        <li>Your Content</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">12. Termination</h2>
                    <p>Either party may terminate this agreement at any time:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li><strong>By you:</strong> Cancel your subscription through account settings at any time</li>
                        <li><strong>By us:</strong> We may suspend or terminate your account immediately if you violate these Terms, engage in fraudulent activity, or fail to pay applicable fees</li>
                    </ul>
                    <p class="mt-3">Upon termination, your right to use the Service ceases immediately. We will retain your data for 30 days after termination, during which you may request an export. After 30 days, your data will be permanently deleted.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">13. Governing Law and Disputes</h2>
                    <p>These Terms shall be governed by and construed in accordance with the laws of Cameroon. Any disputes arising from these Terms or your use of the Service shall be resolved through good-faith negotiation first. If negotiation fails, disputes shall be submitted to the competent courts of Cameroon.</p>
                    <p class="mt-3">If you are located in a jurisdiction with mandatory consumer protection laws, those laws may provide you with additional rights that we cannot contractually limit.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">14. Changes to Terms</h2>
                    <p>We reserve the right to modify these Terms at any time. Material changes will be communicated via email or prominent notice within the Service at least 14 days before taking effect. Your continued use of the Service after the effective date constitutes acceptance of the updated Terms.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">15. Contact</h2>
                    <p>For questions about these Terms, contact us:</p>
                    <div class="mt-3 bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <p class="font-semibold text-gray-800">Invento Track</p>
                        <p>Bamenda, North West Region, Cameroon</p>
                        <p>Email: <a href="mailto:esanglesley@gmail.com" class="text-indigo-600 hover:underline">esanglesley@gmail.com</a></p>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <footer class="border-t border-gray-200 py-8 px-6 bg-white">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">© {{ date('Y') }} Invento Track. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="{{ route('privacy') }}" class="text-sm text-gray-500 hover:text-gray-900">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-sm text-indigo-600 font-medium">Terms of Service</a>
                <a href="{{ route('cookies') }}" class="text-sm text-gray-500 hover:text-gray-900">Cookie Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>
