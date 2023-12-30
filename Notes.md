## Technologies used

- Laravel 10.10
- PHP 8.1
- Vue 3

## Analysis and Planning

- Since the heart of the application will be on accessing various APIs from news sites, it is relevant to focus the majority of the planning on this part
- A factory for current and future News API is necessary
- A search function that allows using multiple factories (and exclude if necessary) should be added
- A simple ranking mechanism for results coming from multiple APIs
- A pin/unpin functionality, with information saved locally
- Also a class representing each articles is needed
- Certain level of abstraction is needed to allow modification and extension
- But not too much to a point of obfuscation
