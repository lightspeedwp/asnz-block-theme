import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';

registerBlockType('asnz/envira-gallery', {
    edit: (props) => {
        const { attributes } = props;
        // Show preview, no editing in block (meta handled in SCF UI)
        return (
            <>
                <ServerSideRender
                    block="asnz/envira-gallery"
                    attributes={attributes}
                />
                <p className="components-help">
                    {__(
                        'The Envira Gallery is determined by the SCF field (envira_gallery) for this post.',
                        'asnz-block-theme'
                    )}
                </p>
            </>
        );
    },
    save: () => null, // Dynamic block - rendered with PHP.
});
