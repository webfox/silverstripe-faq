# silverstripe-faq
A FAQ module for silverstripe that implements the backend on any pagetype via an extension but does not dictate the frontend!

## How to use

### Install through composer
```bash
composer require silverstripe-faq
```

### Apply to any pagetype you want the "Faq Segments" tab to appear on (can be applied to multiple page types)
```yaml
Page:
  extensions:
    - FrequentlyAskedQuestionsExtension
```

### Use on the frontend

```
<% if $Faqs.exists %>
    <% loop $Faqs %>
        <h2>Q. {$Title}</h2>
        <strong>A.</strong> {$Answer}
    <% end_loop %>
<% end_if %>
```
