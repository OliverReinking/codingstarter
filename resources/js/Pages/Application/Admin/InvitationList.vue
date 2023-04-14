<template>
    <admin-layout>
        <template #breadcrumb>
            <breadcrumb
                :application-name="$page.props.applications.app_admin"
                current="Liste der Teammitglieder-Einladungen"
            ></breadcrumb>
        </template>

        <template v-if="Object.keys(invitations).length > 0">
            <section-content class="mb-6" :full-width="true">
                <template #title> Eingeladene Teammitglieder </template>

                <template #description>
                    Hier kannst du die Liste aller eingeladenen Teammitglieder
                    einsehen.
                    <!-- Loading -->
                    <input-loading
                        :loading="loading"
                        :loading-text="loadingText"
                    ></input-loading>
                    <!-- ENDS Loading -->
                </template>
                <template #content>
                    <div class="np-dl-outer-container">
                        <div class="np-dl-data-container">
                            <table class="np-dl-table">
                                <thead class="np-dl-thead">
                                    <tr>
                                        <th class="np-dl-th-normal">
                                            eingeladen am
                                        </th>
                                        <th class="np-dl-th-normal">Name</th>
                                        <th class="np-dl-th-normal">Mail</th>
                                        <th class="np-dl-th-normal">
                                            Anwendung
                                        </th>
                                        <th class="np-dl-th-normal">Status</th>
                                        <th class="np-dl-th-normal">
                                            widerrufen
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="member in invitations"
                                        :key="member.id"
                                        class="np-dl-tr"
                                    >
                                        <td class="np-dl-td-normal">
                                            <display-date
                                                :value="member.created_at"
                                                :time-on="true"
                                            ></display-date>
                                        </td>
                                        <td class="np-dl-td-normal">
                                            {{ member.first_name }}
                                            {{ member.last_name }}
                                        </td>
                                        <td class="np-dl-td-normal">
                                            {{ member.email }}
                                        </td>
                                        <td class="np-dl-td-normal">
                                            {{ member.application }}
                                        </td>
                                        <td class="np-dl-td-normal">
                                            {{ member.status }}
                                        </td>
                                        <td class="np-dl-td-normal">
                                            <input-icon-button
                                                @click.prevent="
                                                    deleteInvitation(member.id)
                                                "
                                            >
                                                <template #icon>
                                                    <icon-trash
                                                        class="h-5 w-5 mr-2"
                                                    ></icon-trash>
                                                </template>
                                                Einladung widerrufen
                                            </input-icon-button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </section-content>
        </template>

        <alert type="info" v-if="Object.keys(invitations).length == 0">
            Zur Zeit liegen keine Einladungen an Teammitglieder vor!
        </alert>
    </admin-layout>
</template>

<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import SmoothScroll from "@/Pages/Components/SmoothScroll.vue";

import SectionContent from "@/Pages/Components/Content/SectionContent.vue";
import SectionForm from "@/Pages/Components/Content/SectionForm.vue";
import SectionBorder from "@/Pages/Components/Content/SectionBorder.vue";

import ButtonGroup from "@/Pages/Components/Form/ButtonGroup.vue";
import InputButton from "@/Pages/Components/Form/InputButton.vue";
import InputDangerButton from "@/Pages/Components/Form/InputDangerButton.vue";

import InputLoading from "@/Pages/Components/Form/InputLoading.vue";

import InputIconButton from "@/Pages/Components/Form/InputIconButton.vue";
import IconTrash from "@/Pages/Components/Icons/Trash.vue";

import Alert from "@/Pages/Components/Content/Alert.vue";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

export default defineComponent({
    name: "Admin_InvitationList",

    components: {
        AdminLayout,
        Breadcrumb,
        SmoothScroll,
        SectionContent,
        SectionForm,
        SectionBorder,
        ButtonGroup,
        InputButton,
        InputDangerButton,
        InputLoading,
        InputIconButton,
        IconTrash,
        Alert,
        DisplayDate,
    },

    props: {
        invitations: {
            type: Object,
            default: () => ({}),
        },
        errors: {
            type: Object,
            default: () => ({}),
        },
    },

    data() {
        return {
            loading: false,
            loadingText: null,
        };
    },

    methods: {
        deleteInvitation(id) {
            this.loading = true;
            this.loadingText = "Die ausgewählte Einladung wird widerrufen!";
            //
            this.$inertia.delete(this.route("admin.invitation.delete", id), {
                onSuccess: () => {
                    this.loading = false;
                },
                onError: () => {
                    this.loading = false;
                },
            });
        },
    },
});
</script>
