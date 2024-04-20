<template>
    <div class="container mx-auto">
        <Card class="bg-emerald-800">
            <template #content>
                <Accordion :activeIndex="0">
                    <AccordionTab header="SILVA Social Media Marketing Terms & Conditions">
                        <p>
                            These Terms & Conditions ("Terms") govern the use of the Engagegenius website ("Website")
                            and the services offered by Engagegenius ("Services"). By accessing or using the Website or
                            Services, you agree to be bound by these Terms
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Services">
                        <p>Engagegenius provides social media marketing services to help businesses grow their online
                            presence and engagement. Services may include, but are not limited to:
                        </p>
                        <ul>
                            <li>Social media strategy development</li>
                            <li>Content creation and management</li>
                            <li>Community management</li>
                            <li>Community management</li>
                            <li>Paid advertising campaigns</li>
                            <li>Social media analytics reporting</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="Client Responsibilities">
                        <ul>
                            <li>You are responsible for providing accurate and complete information about your business
                                and target audience.</li>
                            <li>You are responsible for approving all content created by Engagegenius for your social
                                media channels.</li>
                            <li>You are responsible for complying with all applicable laws and regulations regarding
                                your social media activity.</li>
                            <li>You grant Engagegenius a non-exclusive, royalty-free license to use your trademarks and
                                logos for the purposes of delivering the Services.</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="Payment Terms">
                        <ul>
                            <li>Payment terms will be outlined in a separate service agreement for each client.</li>
                            <li>Payment is due upon receipt of invoice.</li>
                            <li>Late payments may be subject to late fees.</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="Term and Termination">
                        <ul>
                            <li>Payment terms will be outlined in a separate service agreement for each client.</li>
                            <li>Payment is due upon receipt of invoice.</li>
                            <li>Late payments may be subject to late fees.</li>
                        </ul>
                    </AccordionTab>

                    <AccordionTab header="Intellectual Propert">
                        <ul>
                            <li>Engagegenius retains all ownership rights to its intellectual property, including its
                                website content, methodologies, and processes.</li>
                            <li>You retain all ownership rights to your intellectual property, including your trademarks
                                and logos.</li>
                        </ul>
                    </AccordionTab>
                    <AccordionTab header="Confidentiality">
                        <ul>
                            <li>Engagegenius will keep confidential all non-public information received from you.</li>
                            <li>You will keep confidential all non-public information received from Engagegenius.</li>
                        </ul>
                    </AccordionTab>
                    <AccordionTab header="Disclaimer of Warranties">
                        <ul>
                            <li>Engagegenius disclaims all warranties, express or implied, including but not limited to
                                warranties of merchantability, fitness for a particular purpose, and non-infringement.
                            </li>
                            <li>Engagegenius does not guarantee the results of its Services.</li>
                        </ul>
                    </AccordionTab>
                    <AccordionTab header="imitation of Liability">
                        <p>
                            Engagegenius will not be liable for any damages arising out of or related to the use of the Website or Services, including but not limited to direct, indirect, incidental, consequential, or punitive damages.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Force Majeure">
                        <p>
                            Engagegenius will not be liable for any delays or failures in performance due to causes beyond its reasonable control, such as acts of God, war, terrorism, or natural disasters.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Governing Law">
                        <p>
                            These Terms will be governed by and construed in accordance with the laws of the State of California.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Entire Agreement">
                        <p>
                            These Terms constitute the entire agreement between you and Engagegenius regarding the use of the Website and Services.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Severability">
                        <p>
                            If any provision of these Terms is held to be invalid or unenforceable, such provision shall be struck and the remaining provisions shall remain in full force and effect.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Waiver">
                        <p>
                            No waiver by Engagegenius of any breach of these Terms will be deemed a waiver of any subsequent breach.
                        </p>
                    </AccordionTab>
                    <AccordionTab header="Contact Us">
                        <p>
                            f you have any questions about these Terms, please contact us at <a href="mailto:Engagegenius@gmail.com">Engagegenius@gmail.com</a>
                        </p>
                    </AccordionTab>
                </Accordion>
                <p><em>Please note: These Terms & Conditions are a sample and may need to be modified to fit your specific business needs and comply with local laws. You may want to consult with an attorney to ensure your Terms & Conditions are comprehensive and legally sound.</em></p>
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