# Manual Test Checklist

To ensure BloodConnect's core features are functioning as expected, perform the following quality assurance (QA) steps manually:

1. **Test Registration & Validation**
   - Attempt to submit the registration form with an invalid Nepali phone number (e.g., 98012) or being under 18 years old. Ensure server-side validation messages appear and the form is rejected.
2. **Test Spam Protections**
   - **Honeypot:** Using browser developer tools, unhide the `website` input field on the registration form, fill it with a value, and submit. Verify that you receive a success message, but the record is *not* saved to the database.
   - **Rate Limiting:** Submit 4 valid registrations consecutively. Ensure the 4th attempt is blocked with a "maximum number of registrations" error message.
3. **Test Search and 56-Day Cooldown Eligibility**
   - Register a new donor with a `last_donation_date` of exactly 10 days ago. Ensure they **do not** appear in the search results for their district and blood group.
   - Update that donor's `last_donation_date` to 60 days ago. Ensure they **do** now appear in the search results.
4. **Test Self-Service Management (Magic Link)**
   - Copy the "magic link" provided after a successful registration. 
   - Open it in an incognito window (to prove no login is required).
   - Toggle the availability switch to "Hide my profile" and save. 
   - Verify the donor no longer appears in search results.
5. **Test the "Call Donor" Fallback UI**
   - Search for an active donor and verify their contact number is directly displayed on the search result card as a clickable `tel:` link, making it instantly accessible for seekers on mobile devices.
