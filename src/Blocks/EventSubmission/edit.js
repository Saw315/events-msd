import { useBlockProps } from '@wordpress/block-editor';

const Edit = () => {
    return (
        <div { ...useBlockProps() }>
            <p>Event Submission Form will be rendered here.</p>
        </div>
    );
};

export default Edit;