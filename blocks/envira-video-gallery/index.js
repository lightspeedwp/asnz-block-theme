import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';

registerBlockType('asnz/envira-video-gallery', {
    edit: (props) => {
        const { attributes } = props;
        // Show preview, no editing in block (meta handled in SCF UI)
        return (
            <ServerSideRender
                block="asnz/envira-video-gallery"
                attributes={attributes}
            />
        );
    },
    save: () => null, // Dynamic block - rendered with PHP.
});
