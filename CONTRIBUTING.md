# Contributing to Themantic

Thank you for your interest in contributing to Themantic! We welcome contributions from the community.

## How to Contribute

### Reporting Bugs

1. Check if the bug has already been reported in [Issues](https://github.com/daemondevin/themantic/issues)
2. If not, create a new issue with:
   - Clear title and description
   - Steps to reproduce
   - Expected vs actual behavior
   - MODx and PHP versions
   - Screenshots if applicable

### Suggesting Features

1. Check existing feature requests
2. Create a new issue with the `enhancement` label
3. Describe the feature and its use case
4. Explain why it would be valuable

### Pull Requests

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Make your changes
4. Test thoroughly
5. Commit with clear messages
6. Push to your fork
7. Submit a pull request

## Development Setup

1. Clone your fork:
   ```bash
   git clone https://github.com/daemondevin/themantic.git
   cd themantic
   ```

2. Install dependencies:
   ```bash
   npm install
   composer install
   ```

3. Create a development build:
   ```bash
   npm run build
   ```

## Coding Standards

### PHP
- Follow MODx coding standards
- Use PSR-4 autoloading
- Document all functions and classes
- Keep code DRY (Don't Repeat Yourself)

### JavaScript
- Use ES6+ features where appropriate
- Follow jQuery best practices for Semantic UI integration
- Comment complex logic
- Keep functions small and focused

### CSS
- Follow Semantic UI conventions
- Use meaningful class names
- Keep specificity low
- Comment sections clearly

### Templates
- Use proper MODx tag syntax
- Keep logic minimal in templates
- Document template variables
- Ensure cross-browser compatibility

## Testing

Before submitting:
- Test on fresh MODx installation
- Test all templates
- Verify responsive design
- Check browser compatibility
- Clear cache and test again

## Documentation

- Update README.md if needed
- Add/update installation steps
- Document new features
- Include code examples

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

## Questions?

Feel free to ask questions in the [Discussions](https://github.com/daemondevin/themantic/discussions) section.

Thank you for contributing!
