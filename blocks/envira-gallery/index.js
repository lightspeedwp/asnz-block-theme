import { registerBlockType } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import { ServerSideRender } from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';

registerBlockType('asnz/envira-gallery', {
    edit: (props) => {
        const { attributes, setAttributes } = props;
        // Show preview, no editing in block (meta handled in SCF UI)
        return (
            <>
                <ServerSideRender
                    block="asnz/envira-gallery"
                    attributes={attributes}
                />
                <p className="components-help">
                    {__(
                        'The Envira Gallery is determined by the SCF field (envira_gallery_id) for this post.',
                        'asnz'
                    )}
                </p>
            </>
        );
    },
    save: () => null, // Dynamic block - rendered with PHP.
});
