import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType('asnz/best-time-to-visit', {
    edit: (props) => {
        const { attributes } = props;
        return (
            <ServerSideRender
                block="asnz/best-time-to-visit"
                attributes={attributes}
            />
        );
    },
    save: () => null, // Dynamic block - rendered with PHP.
});
