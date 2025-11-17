import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';

registerBlockType('asnz/highlights', {
    edit: (props) => {
        const { attributes } = props;
        return (
            <ServerSideRender block="asnz/highlights" attributes={attributes} />
        );
    },
    save: () => null, // Dynamic block - rendered with PHP.
});
