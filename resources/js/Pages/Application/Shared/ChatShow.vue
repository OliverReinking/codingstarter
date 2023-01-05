<template>
  <section-content class="mt-8">
    <template #title> Nachricht </template>
    <template #description> Hier sieht du alle Daten der Nachricht
    </template>
    <template #content>
      <display-row label="Nachricht">
        <template #content>
          <span v-html="chat.message"></span>
        </template>
      </display-row>
      <display-row label="gesendet am">
        <template #content>
          <display-date :value="chat.chat_date" :time-on="true" />
        </template>
      </display-row>
      <display-row label="Absender der Nachricht">
        <template #content>
          <chat-sender-receiver-info
            :sender-on="true"
            :user-id="chat.sender_user_id"
            :user-name="chat.sender_user_name"
            :company-id="chat.sender_person_company_id"
            :company-name="chat.sender_person_company_name"
            :type-id="chat.sender_user_type_id"
            :type-name="chat.sender_type_name"
          ></chat-sender-receiver-info>
        </template>
      </display-row>
      <display-row label="Empfänger der Nachricht">
        <template #content>
          <chat-sender-receiver-info
            :sender-on="false"
            :user-id="chat.receiver_user_id"
            :user-name="chat.receiver_user_name"
            :company-id="chat.receiver_person_company_id"
            :company-name="chat.receiver_person_company_name"
            :type-id="chat.receiver_user_type_id"
            :type-name="chat.receiver_type_name"
          ></chat-sender-receiver-info>
        </template>
      </display-row>
      <display-row label="Wurde die Nachricht gelesen?">
        <template #content>
          <display-yes-or-no :value="chat.read_status" />
        </template>
      </display-row>
      <display-row label="gelesen am" v-if="chat.read_status">
        <template #content>
          <display-date :value="chat.read_date" :time-on="true" />
        </template>
      </display-row>
    </template>
  </section-content>

  <template v-if="chathistory.length > 0">
    <section-border></section-border>
    <section-content>
      <template #title>Historie</template>
      <template #description
        >Hier findest du alle bisherigen Nachrichten von:

        <div v-if="inbox" class="font-extrabold">
          <chat-sender-receiver-info
            :sender-on="true"
            :user-id="chat.sender_user_id"
            :user-name="chat.sender_user_name"
            :company-id="chat.sender_person_company_id"
            :company-name="chat.sender_person_company_name"
            :type-id="chat.sender_user_type_id"
            :type-name="chat.sender_type_name"
          ></chat-sender-receiver-info>
        </div>
        <div v-else class="font-extrabold">
          <chat-sender-receiver-info
            :sender-on="false"
            :user-id="chat.receiver_user_id"
            :user-name="chat.receiver_user_name"
            :company-id="chat.receiver_person_company_id"
            :company-name="chat.receiver_person_company_name"
            :type-id="chat.receiver_user_type_id"
            :type-name="chat.sender_type_name"
          ></chat-sender-receiver-info>
        </div>
      </template>
      <template #content>
        <accordion title="Historie">
          <template #content>
            <table class="np-dl-table">
              <thead class="np-dl-thead">
                <tr>
                  <th class="np-dl-th-normal">Datum</th>
                  <th class="np-dl-th-normal">Absender</th>
                  <th class="np-dl-th-normal">Nachricht</th>
                  <th class="np-dl-th-normal">Lesestatus</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="singlechat in chathistory"
                  :key="singlechat.id"
                  class="np-dl-tr"
                >
                  <td class="np-dl-td-normal">
                    <display-date
                      :value="singlechat.chat_date"
                      :time-on="true"
                    />
                  </td>
                  <td class="np-dl-td-normal">
                    <div
                      v-if="
                        inbox &&
                        chat.sender_person_company_id == singlechat.sender_person_company_id
                      "
                    >
                      {{ singlechat.sender_person_company_name }}
                    </div>
                    <div
                      v-else-if="
                        inbox &&
                        chat.sender_person_company_id != singlechat.sender_person_company_id
                      "
                    >
                      Ich
                    </div>
                    <div
                      v-else-if="
                        !inbox &&
                        chat.sender_person_company_id != singlechat.sender_person_company_id
                      "
                    >
                      Ich
                    </div>
                    <div
                      v-else-if="
                        !inbox &&
                        chat.sender_person_company_id == singlechat.sender_person_company_id
                      "
                    >
                      {{ singlechat.receiver_person_company_name }}
                    </div>
                    <div v-else>unbekannt</div>

                    <div class="hidden">
                      {{ inbox }}
                      <br />
                      chat.sender_person_company_id: {{ chat.sender_person_company_id }}
                      <br />
                      chat.receiver_person_company_id: {{ chat.receiver_person_company_id }}
                      <br />
                      singlechat.sender_person_company_id:
                      {{ singlechat.sender_person_company_id }}
                      <br />
                      singlechat.receiver_person_company_id:
                      {{ singlechat.receiver_person_company_id }}
                      <br />
                      singlechat.receiver_person_company_name:
                      {{ singlechat.receiver_person_company_name }}
                    </div>
                  </td>
                  <td class="np-dl-td-normal">
                    <span v-html="singlechat.message">
                    </span>
                  </td>
                  <td class="np-dl-td-normal">
                    <div v-if="singlechat.read_status">
                      gelesen am
                      <display-date
                        :value="singlechat.read_date"
                        :time-on="true"
                      />
                    </div>
                    <div v-else>ungelesen</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </template>
        </accordion>
      </template>
    </section-content>
  </template>

  <div class="hidden">
    chathistory.length: {{ chathistory.length }}
    <br />
    chathistory: {{ chathistory }}
  </div>
</template>
<script>
import SectionContent from "@/Pages/Components/Content/SectionContent.vue";
import SectionBorder from "@/Pages/Components/Content/SectionBorder.vue";

import ChatSenderReceiverInfo from "@/Pages/Application/Shared/ChatSenderReceiverInfo.vue";

import DisplayRow from "@/Pages/Components/Content/DisplayRow.vue";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";
import DisplayYesOrNo from "@/Pages/Components/Content/DisplayYesOrNo.vue";

import Accordion from "@/Pages/Components/Content/Accordion.vue";

export default {
  name: "Shared_ChatShow",
  //
  components: {
    SectionContent,
    SectionBorder,
    ChatSenderReceiverInfo,
    DisplayRow,
    DisplayDate,
    DisplayYesOrNo,
    Accordion,
  },

  props: {
    inbox: {
      type: Boolean,
      required: true,
    },
    chat: {
      type: Object,
    },
    chathistory: {
      type: Object,
    },
  },
};
</script>
