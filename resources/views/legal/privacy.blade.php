<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy — Invento Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
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

    {{-- Content --}}
    <div class="max-w-4xl mx-auto px-6 py-16">
        <div class="bg-white rounded-2xl border border-gray-200 p-8 md:p-12 shadow-sm">

            <div class="mb-10">
                <h1 class="text-3xl font-black text-gray-900 mb-3">Privacy Policy</h1>
                <p class="text-gray-500 text-sm">Last updated: {{ date('F d, Y') }} · Effective: {{ date('F d, Y') }}</p>
            </div>

            <div class="prose prose-gray max-w-none space-y-8 text-sm leading-relaxed text-gray-600">

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">1. Introduction</h2>
                    <p>Invento Track ("we", "our", or "us") is committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our inventory management platform at inventotrack.com and related services (collectively, the "Service").</p>
                    <p class="mt-3">By accessing or using our Service, you agree to the collection and use of information in accordance with this policy. If you disagree with any part of this policy, please do not use our Service.</p>
                    <p class="mt-3">We are based in Cameroon and operate under applicable data protection laws. Where you are located in a jurisdiction with specific data protection requirements (such as the EU's GDPR), we will comply with those requirements.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">2. Information We Collect</h2>
                    <p class="font-semibold text-gray-700 mb-2">2.1 Information You Provide Directly</p>
                    <ul class="list-disc list-inside space-y-1 ml-2">
                        <li><strong>Account information:</strong> Company name, email address, password (stored as a one-way hash — we never store your plain-text password)</li>
                        <li><strong>Business data:</strong> Products, categories, stock levels, suppliers, customers, purchase orders, sales orders, invoices, and payment records you enter into the platform</li>
                        <li><strong>Billing information:</strong> Subscription plan selection and payment method details (processed by our payment processor; we do not store full card numbers)</li>
                        <li><strong>Communications:</strong> Messages or requests you send to our support team</li>
                        <li><strong>Settings and preferences:</strong> Timezone, currency, and other configuration you set</li>
                    </ul>

                    <p class="font-semibold text-gray-700 mb-2 mt-4">2.2 Information Collected Automatically</p>
                    <ul class="list-disc list-inside space-y-1 ml-2">
                        <li><strong>Log data:</strong> IP address, browser type and version, pages visited, time and date of visits, time spent on pages</li>
                        <li><strong>Device information:</strong> Device type, operating system, unique device identifiers</li>
                        <li><strong>Cookies and tracking:</strong> Session cookies (required for login), preference cookies, and analytics cookies (see our Cookie Policy)</li>
                        <li><strong>Usage data:</strong> Features used, actions taken within the application, error logs</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">3. How We Use Your Information</h2>
                    <p>We use the information we collect for the following purposes:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li><strong>Providing the Service:</strong> To operate, maintain, and improve Invento Track, process transactions, and send related information including confirmations and invoices</li>
                        <li><strong>Account management:</strong> To create and manage your account, authenticate your identity, and allow you to access the Service</li>
                        <li><strong>Customer support:</strong> To respond to your comments, questions, and requests</li>
                        <li><strong>Security:</strong> To detect, prevent, and address technical issues, fraud, and abuse</li>
                        <li><strong>Communications:</strong> To send you technical notices, updates, security alerts, and support messages</li>
                        <li><strong>Analytics:</strong> To understand how our Service is used and improve it</li>
                        <li><strong>Legal compliance:</strong> To comply with applicable laws and enforce our terms</li>
                    </ul>
                    <p class="mt-3">We do <strong>not</strong> sell, rent, or share your personal data or your business data with third parties for their marketing purposes.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">4. Multi-Tenant Data Isolation</h2>
                    <p>Invento Track is a multi-tenant platform. This means multiple businesses use the same platform infrastructure. We take the following measures to ensure your data is completely isolated from other businesses:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li>Every data record is tagged with a unique Tenant ID (UUID) at the database level</li>
                        <li>Every database query is scoped to your Tenant ID — it is technically impossible to retrieve another tenant's data through normal use of the application</li>
                        <li>Our application enforces access control checks on every API endpoint and controller action</li>
                        <li>Employees of Invento Track can access tenant data only for legitimate support purposes and are bound by confidentiality obligations</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">5. Data Sharing and Disclosure</h2>
                    <p>We may share your information only in the following circumstances:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li><strong>Service providers:</strong> With third-party vendors who assist in operating our platform (hosting providers, email services, payment processors). These vendors are contractually bound to keep your data confidential and use it only to provide their services to us.</li>
                        <li><strong>Legal requirements:</strong> If required by law, court order, or governmental authority</li>
                        <li><strong>Business transfers:</strong> In connection with a merger, acquisition, or sale of assets, with notice to you</li>
                        <li><strong>Protection of rights:</strong> To protect the rights, property, or safety of Invento Track, our users, or others</li>
                        <li><strong>With your consent:</strong> In any other case, only with your explicit consent</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">6. Data Security</h2>
                    <p>We implement industry-standard security measures to protect your information:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li>All passwords are hashed using bcrypt — we cannot recover your password</li>
                        <li>All data transmission is encrypted using HTTPS/TLS</li>
                        <li>Database access is restricted and monitored</li>
                        <li>We use UUID primary keys to prevent sequential ID enumeration attacks</li>
                        <li>Regular security updates and vulnerability patching</li>
                    </ul>
                    <p class="mt-3">However, no method of transmission over the Internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your personal information, we cannot guarantee its absolute security.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">7. Data Retention</h2>
                    <p>We retain your personal information and business data for as long as your account is active or as needed to provide you the Service. If you close your account:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li>Your account and all associated business data will be scheduled for deletion within 30 days</li>
                        <li>We may retain certain information as required by law or for legitimate business purposes (e.g., fraud prevention) for up to 7 years</li>
                        <li>Aggregated, anonymized data may be retained indefinitely for analytics</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">8. Your Rights</h2>
                    <p>Depending on your location, you may have the following rights regarding your personal data:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2 mt-3">
                        <li><strong>Access:</strong> Request a copy of the personal data we hold about you</li>
                        <li><strong>Rectification:</strong> Request correction of inaccurate data</li>
                        <li><strong>Erasure:</strong> Request deletion of your personal data ("right to be forgotten")</li>
                        <li><strong>Portability:</strong> Request your data in a structured, machine-readable format</li>
                        <li><strong>Objection:</strong> Object to processing of your data for certain purposes</li>
                        <li><strong>Restriction:</strong> Request restriction of processing in certain circumstances</li>
                    </ul>
                    <p class="mt-3">To exercise any of these rights, contact us at <a href="mailto:esanglesley@gmail.com" class="text-indigo-600 hover:underline">esanglesley@gmail.com</a>. We will respond within 30 days.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">9. Cookies</h2>
                    <p>We use cookies and similar tracking technologies to operate the Service. For detailed information about the cookies we use and your choices, please see our <a href="{{ route('cookies') }}" class="text-indigo-600 hover:underline">Cookie Policy</a>.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">10. Children's Privacy</h2>
                    <p>Our Service is not directed to individuals under the age of 18. We do not knowingly collect personal information from children. If you become aware that a child has provided us with personal data, please contact us and we will take steps to delete such information.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">11. International Data Transfers</h2>
                    <p>Your information may be transferred to and processed in countries other than your country of residence. These countries may have different data protection laws. We take appropriate safeguards to ensure your personal data remains protected in accordance with this Privacy Policy.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">12. Changes to This Policy</h2>
                    <p>We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new policy on this page and updating the "Last updated" date. We encourage you to review this page periodically. Your continued use of the Service after any changes constitutes your acceptance of the updated policy.</p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">13. Contact Us</h2>
                    <p>If you have questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>
                    <div class="mt-3 bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <p class="font-semibold text-gray-800">Invento Track</p>
                        <p>Bamenda, North West Region, Cameroon</p>
                        <p>Email: <a href="mailto:esanglesley@gmail.com" class="text-indigo-600 hover:underline">esanglesley@gmail.com</a></p>
                        <p>Website: <a href="{{ url('/') }}" class="text-indigo-600 hover:underline">{{ url('/') }}</a></p>
                    </div>
                </section>

            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="border-t border-gray-200 py-8 px-6 bg-white">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">© {{ date('Y') }} Invento Track. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="{{ route('privacy') }}" class="text-sm text-indigo-600 font-medium">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-sm text-gray-500 hover:text-gray-900">Terms of Service</a>
                <a href="{{ route('cookies') }}" class="text-sm text-gray-500 hover:text-gray-900">Cookie Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>
