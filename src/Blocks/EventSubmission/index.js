import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit: () => {
        return (
            <div { ...useBlockProps() }>
                <p>Event Submission Form (Rendered on Frontend)</p>
            </div>
        );
    },
    save: () => null
});
