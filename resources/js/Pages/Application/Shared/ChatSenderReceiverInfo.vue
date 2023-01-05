<template>
  <div>
    <div v-if="userId > 0 && typeId == 1">
      von {{ userName }}
    </div>
    <div v-else-if="userId > 0 && typeId == 2">
      Unternehmen {{ companyName }}, von {{ userName }}
    </div>
    <div v-else-if="userId > 0 && typeId == 3">
      Plattform {{ companyName }}, von {{ userName }}
    </div>
    <div v-else-if="companyId > 0 && typeId == 1">
      <span v-if="typeName">{{ typeName }}&nbsp;</span>
      <span v-else>Kunde&nbsp;</span>
      <span> {{ companyName }}</span>
      <span v-if="userName">verfasst von {{ userName }}</span>
    </div>
    <div v-else-if="companyId > 0 && typeId == 2">
      <span v-if="typeName">{{ typeName }}&nbsp;</span>
      <span v-else>Unternehmen&nbsp;</span>
      <span> {{ companyName }}</span>
      <span v-if="userName">(verfasst von {{ userName }})</span>
    </div>
    <div v-else-if="companyId > 0 && typeId == 3">
      <span v-if="typeName">{{ typeName }}&nbsp;</span>
      <span v-else>Plattform&nbsp;</span>
      <span> {{ companyName }}</span>
      <span v-if="userName">(verfasst von {{ userName }})</span>
    </div>
    <div v-else-if="senderOn">Sender konnte nicht bestimmt werden!</div>
    <div v-else>Absender konnte nicht bestimmt werden!</div>
  </div>

  <div class="hidden">
    senderOn: {{ senderOn }}
    <br />
    userId: {{ userId }}
    <br />
    userName: {{ userName }}
    <br />
    companyId: {{ companyId }}
    <br />
    companyName: {{ companyName }}
    <br />
    typeId: {{ typeId }}
    <br />
    typeName: {{ typeName }}
    <br />
  </div>
</template>
<script>
export default {
  name: "Content_ChatSenderReceiverInfo",

  props: {
    senderOn: {
      type: Boolean,
      default: false,
    },
    userId: {
      type: Number,
    },
    userName: {
      type: String,
    },
    companyId: {
      type: Number,
    },
    companyName: {
      type: String,
    },
    typeId: {
      type: Number,
    },
    typeName: {
      type: String,
    },
  },
};
</script>
