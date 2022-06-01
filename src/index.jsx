/**
* Internal dependencies
*/
const registerBlockType = window.wp.blocks.registerBlockType

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
registerBlockType('my/book', {
  title: 'Book',
  description: 'A simple book block.',
  category: 'text',
  icon: 'book-alt',

  edit: (props) => {

    // Get WP packages.
    const RichText = window.wp.blockEditor.RichText;
    const TextControl = window.wp.components.TextControl;
    const Fragment = window.wp.element.Fragment;

    // Get block properties.
    const { setAttributes } = props;
    const { title, author, summary } = props.attributes;

    // Set on change callbacks.
    const onChangeTitle = (value) => { setAttributes({ title: value }) };
    const onChangeAuthor = (value) => { setAttributes({ author: value }) };
    const onChangeSummary = (value) => { setAttributes({ summary: value }) };

    // Return the edit markup.
    return (
      <Fragment>
        <TextControl
          label='Title'
          value={title}
          onChange={onChangeTitle}
        />

        <TextControl
          label='Author'
          value={author}
          onChange={onChangeAuthor}
        />

        <RichText
          placeholder='Book summary goes here.'
          value={summary}
          onChange={onChangeSummary}
          allowedFormats={['core/bold', 'core/italic']}
        />
      </Fragment>
    );

  },

  save: () => {
    return null;
  }

});