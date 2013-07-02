# Syncronex

### Test/production code for Syncronex's Digital Paymeter API.

---

[Syncronex](http://www.syncronex.com/)'s Digital Paymeter system offers two APIs into its content metering rules engine:

1. **Default:** This interface is tailored to the current Digital Paymeter HTML-based "lightbox" solution (where all user facing elements are controlled by Syncronex/[DTI](http://www.dtint.com/)). This is the default solution typically put in place, by most new customers, to meter their websites.
1. **Standard:** This interface is specific to external systems like native smart device applications, replica edition systems, and other non-Syncronex/DTI systems wishing to leverage the consistent set of content metering business rules established by the Newspaper customer.
This repository contains custom, non-official, code (mashed-up by [@mhulse](https://github.com/mhulse) at [The Register-Guard](http://www.registerguard.com)) that leverages these two interfaces.
The [`default-api`](https://github.com/registerguard/syncwall/tree/default-api) branch is the HTML-based solution used exclusively by the current Syncronex/DTI lightbox features and the [`standard-api`](https://github.com/registerguard/syncwall/tree/standard-api) branch is to be used by external systems.
Please visit the other branches to browse through the code.