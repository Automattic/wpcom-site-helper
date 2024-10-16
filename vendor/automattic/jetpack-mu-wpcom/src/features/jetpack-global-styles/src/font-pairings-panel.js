import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { ENTER } from '@wordpress/keycodes';
import clsx from 'clsx';
import NoSupport from './no-support';

export default ( { fontPairings, fontBase, fontHeadings, update } ) => {
	return (
		<>
			<h3>{ __( 'Font Pairings', 'jetpack-mu-wpcom' ) }</h3>
			{ fontPairings && fontHeadings && fontBase ? (
				<div className="style-preview__font-options">
					<div className="style-preview__font-options-desktop">
						{ fontPairings.map( ( { label, headings, base } ) => {
							const isSelected = headings === fontHeadings && base === fontBase;
							return (
								<Button
									className={ clsx( 'style-preview__font-option', {
										'is-selected': isSelected,
									} ) }
									onClick={ () => update( { headings, base } ) }
									onKeyDown={ event =>
										event.keyCode === ENTER ? update( { headings, base } ) : null
									}
									key={ label }
								>
									<span className="style-preview__font-option-contents">
										<span style={ { fontFamily: headings, fontWeight: 700 } }>{ headings }</span>
										&nbsp;/&nbsp;
										<span style={ { fontFamily: base } }>{ base }</span>
									</span>
								</Button>
							);
						} ) }
					</div>
				</div>
			) : (
				<NoSupport unsupportedFeature={ __( 'font pairings', 'jetpack-mu-wpcom' ) } />
			) }
		</>
	);
};
