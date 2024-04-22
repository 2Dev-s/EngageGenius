<template>
    <div class="container mx-auto">
        <Card class="bg-emerald-800">
            <template #title> Privacy Policy </template>
            <template #content>
                <Accordion :activeIndex="0">
                    <AccordionTab header="Engagegenius Social Media Marketing Privacy Policy">
                        <p>
                            We are committed to protecting the privacy of our website visitors and clients who use our
                            social media marketing services. This Privacy Policy explains what information we collect,
                            how we use it, and under what circumstances we may disclose it.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Information We Collect">
                        <p>We collect two types of information on our website:
                        </p>
                        <ul>
                            <li><strong>Information You Voluntarily Provide:</strong> This includes information you
                                provide when you contact us through our website form, subscribe to our newsletter, or
                                request a quote. This information may include your name, email address, phone number,
                                website URL, and company name.</li>
                            <li><strong>Information Collected Automatically:</strong> When you visit our website, we may
                                automatically collect certain information about your device and browsing activity. This
                                information may include your IP address, browser type, operating system, referring URL,
                                pages visited on our site, and time spent on each page.</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="How We Use Your Information">
                        <p>We use the information we collect for the following purposes:</p>
                        <ul>
                            <li>To respond to your inquiries and requests</li>
                            <li>To provide you with social media marketing services</li>
                            <li>To send you marketing materials, such as newsletters, if you have opted-in</li>
                            <li>To improve our website and marketing efforts</li>
                            <li>To analyze trends and user behavior</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="Sharing Your Information">
                        <p>We will not share your personal information with third parties without your consent, except
                            in the following situations:</p>
                        <ul>
                            <li>To service providers who help us operate our business and website, such as email
                                marketing platforms or data analytics providers. These service providers are obligated
                                to maintain the confidentiality of your information.</li>
                            <li>To comply with legal or regulatory requirements.</li>
                            <li>In the event of a business transfer, such as a merger or acquisition.</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="Data Security">
                        <p>We take reasonable steps to protect your information from unauthorized access, disclosure,
                            alteration, or destruction. However, no website or internet transmission is completely
                            secure.</p>
                    </AccordionTab>

                    <AccordionTab header="Your Choices">
                        <p>You have the following choices regarding your information:</p>
                        <ul>
                            <li>You can opt out of receiving marketing emails from us by clicking the unsubscribe link
                                in any email you receive.</li>
                            <li>You can request access to or deletion of your personal information by contacting us at
                                <a href="mailto:Engagegenius@gmail.com">Engagegenius@gmail.com</a>.</li>
                        </ul>
                    </AccordionTab>
                    <AccordionTab header="California Consumer Privacy Act (CCPA)">
                        <p>If you are a California resident, you have certain rights under the CCPA. You can request to
                            know what personal information we have collected about you, delete your personal
                            information, and opt out of the sale of your personal information.</p>
                    </AccordionTab>
                    <AccordionTab header="Children's Privacy">
                        <p>Our website is not directed to children under the age of 13. We do not knowingly collect
                            personal information from children under 13.</p>
                    </AccordionTab>
                    <AccordionTab header="Changes to this Privacy Policy">
                        <p>We may update this Privacy Policy from time to time. We will post any changes on our website.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Force Majeure">
                        <p>
                            Engagegenius will not be liable for any delays or failures in performance due to causes
                            beyond its reasonable control, such as acts of God, war, terrorism, or natural disasters.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Contact Us">
                        <p>If you have any questions about this Privacy Policy, please contact us at <a
                                href="mailto:Engagegenius@gmail.com">Engagegenius@gmail.com</a>.</p>
                    </AccordionTab>
                </Accordion>
                
                <p><em>This is a sample privacy policy and may need to be modified to comply with specific laws and
                            regulations in your jurisdiction. You may want to consult with an attorney to ensure your
                            privacy policy is compliant.</em></p>
            </template>
        </Card>
    </div>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import Card from 'primevue/card';
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';

defineOptions({ layout: AppLayout });
</script>

<style lang="scss" scoped></style>