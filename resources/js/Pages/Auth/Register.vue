<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import JetRegisterTitle from "@/Components/RegisterTitle.vue";
import JetRegisterSubtitle from "@/Components/RegisterSubtitle.vue";

const form = useForm({
  first_name: "",
  last_name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Head title="Register" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="first_name" :value="$t('First Name')" />
        <JetInput
          id="first_name"
          v-model="form.first_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="first_name"
        />
        <JetInputError class="mt-2" :message="form.errors.first_name" />
      </div>

      <div class="mt-4">
        <JetLabel for="last_name" :value="$t('Last Name')" />
        <JetInput
          id="last_name"
          v-model="form.last_name"
          type="text"
          class="mt-1 block w-full"
          required
          autocomplete="last_name"
        />
        <JetInputError class="mt-2" :message="form.errors.last_name" />
      </div>

      <div class="mt-4">
        <JetLabel for="email" :value="$t('Email')" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
        />
        <JetInputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <JetLabel for="password" :value="$t('Password')" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
        <JetInputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <JetLabel for="password_confirmation" :value="$t('Confirm Password')" />
        <JetInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
        <JetInputError
          class="mt-2"
          :message="form.errors.password_confirmation"
        />
      </div>

           <div class="mt-4">
        <JetRegisterSubtitle title="Daten zum Unternehmen"
          ></JetRegisterSubtitle
        >
      </div>

      <div class="mt-4">
        <JetLabel for="company_name" :value="$t('Company Name')" />
        <JetInput
          id="company_name"
          v-model="form.company_name"
          type="text"
          class="mt-1 block w-full"
          required
        />
        <JetInputError class="mt-2" :message="form.errors.company_name" />
      </div>
      <div class="mt-4">
        <JetLabel for="company_street" :value="$t('Street')" />
        <JetInput
          id="company_street"
          v-model="form.company_street"
          type="text"
          class="mt-1 block w-full"
          required
        />
        <JetInputError class="mt-2" :message="form.errors.company_street" />
      </div>
      <div class="mt-4">
        <JetLabel for="company_postcode" :value="$t('Postcode')" />
        <JetInput
          id="company_postcode"
          v-model="form.company_postcode"
          type="text"
          class="mt-1 block w-full"
          required
        />
        <JetInputError class="mt-2" :message="form.errors.company_postcode" />
      </div>
      <div class="mt-4">
        <JetLabel for="company_city" :value="$t('City')" />
        <JetInput
          id="company_city"
          v-model="form.company_city"
          type="text"
          class="mt-1 block w-full"
          required
        />
        <JetInputError class="mt-2" :message="form.errors.company_city" />
      </div>


      <div
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
        class="mt-4"
      >
        <JetLabel for="terms">
          <div class="flex items-center">
            <JetCheckbox
              id="terms"
              v-model:checked="form.terms"
              name="terms"
              required
            />

            <div class="ml-2">
              {{ $t("I agree to the Terms of Service and Privacy Policy:") }}
              <br />
              <a
                target="_blank"
                :href="route('terms')"
                class="underline text-sm text-layout-600 hover:text-layout-900"
                >{{ $t("Terms of Service") }}</a
              >,
              <a
                target="_blank"
                :href="route('policy')"
                class="underline text-sm text-layout-600 hover:text-layout-900"
                >{{ $t("Privacy Policy") }}</a
              >
            </div>
          </div>
          <JetInputError class="mt-2" :message="form.errors.terms" />
        </JetLabel>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-layout-600 hover:text-layout-900"
        >
          {{ $t("Already registered?") }}
        </Link>

        <JetButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          {{ $t("Register") }}
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>
