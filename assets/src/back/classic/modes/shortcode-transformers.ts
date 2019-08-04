import { uuid } from '@ithoughts/tooltip-glossary/back/common';
import { ETipType, ITag } from '@ithoughts/tooltip-glossary/common';

import { flat, map } from 'iter-tools';
import { shortcodesTypesRegistry } from '../shortcode-types-registry';
import { AShortcode, IShortcodeSearchResult, ShortcodeTransformer } from './a-shortcode';
import { EShortcodeType, ShortcodeType } from './shortcode-type';

export const addTipUuid: ShortcodeTransformer = acc => ( {
	...acc,
	attributes: {
		...acc.attributes,
		tipUuid: uuid( 'tip' ),
	},
} );
export const removeTipUuid: ShortcodeTransformer = acc => ( {
	...acc,
	attributes: {
		...acc.attributes,
		tipUuid: undefined,
	},
} );

export const addClasses = ( classes: string[] ): ShortcodeTransformer => acc => {
	// Try to reuse existing `class` if it exists.
	const existingClasses = acc.attributes && typeof acc.attributes.class !== 'undefined' ?
		String( acc.attributes.class ).split( /\s+/g ) :
		[];
	acc.attributes = {
		...acc.attributes,
		class: classes.concat( existingClasses ).join( ' ' ),
	};
	return acc;
};
export const removeClasses = ( classes: string[] ): ShortcodeTransformer => acc => {
	// Try to reuse existing `class` if it exists
	if ( !acc.attributes || !acc.attributes.class ) {
		return acc;
	}

	const existingClasses = acc.attributes.class.toString().split( /\s+/g );
	acc.attributes.class = existingClasses
		.filter( c => !classes.includes( c ) )
		.join( ' ' ) || undefined;
	return acc;
};

export const addTipType = ( type: ETipType ): ShortcodeTransformer => acc => {
	acc.attributes = {
		...acc.attributes,
		tipType: type,
	};
	return acc;
};
export const removeTipType: ShortcodeTransformer = acc => ( {
	...acc,
	attributes: {
		...acc.attributes,
		tipType: undefined,
	},
} );

export const convertAllType = ( from: EShortcodeType, to: EShortcodeType, content: string ) => {
	const fromTypes = shortcodesTypesRegistry[from];
	if ( !fromTypes ) {
		// tslint:disable-next-line: no-console
		console.warn( `Could not find a shortcode converter from type ${EShortcodeType[from]}` );
		return content;
	}

	const toTypes = shortcodesTypesRegistry[to];
	if ( !toTypes ) {
		// tslint:disable-next-line: no-console
		console.warn( `Could not find a shortcode converter to type ${EShortcodeType[to]}` );
		return content;
	}

	const allConverted = convertAll( fromTypes, toTypes, content );
	console.log( { content, allConverted } );
	return allConverted;
};
export const convertAll = <TFrom extends AShortcode, TTo extends AShortcode>(
	from: Array<ShortcodeType<TFrom>>,
	to: Array<ShortcodeType<TTo>>,
	content: string,
): string => {
	// Get all shortcodes, and keep track of their original type.
	const allShortcodes = ShortcodeType.getAllShortcodes( from, content );

	// For each shortcode + type association, find the target type & convert it
	const mappedShortcodes = map( ( { shortcodeSearchResult, type } ) => {
		const typeTo = to.find( t => t.id === type.id );
		if ( !typeTo ) {
			console.warn( `Could not find a counterpart for type with id ${type.id}` );
			return shortcodeSearchResult;
		} else {
			const converted = typeTo.convert( shortcodeSearchResult.tag );
			return {
				...shortcodeSearchResult,
				tag: converted,
			};
			}
	},                            allShortcodes );

	// Resolve the iterable, and sort
	const sortedShortcodes = [...mappedShortcodes]
		.sort( ( a, b ) => a.start - b.start );

	console.table( sortedShortcodes );

	// Replace each source shortcodes with the replaced content.
	const results = sortedShortcodes
		.reduce( ( { newContent, previousShortcode }, shortcode ) => {
			const junction = content.slice( previousShortcode ? previousShortcode.end : 0, shortcode.start );
			return {
				newContent: newContent + junction + shortcode.tag.toString(),
				previousShortcode: shortcode,
			};
		},       { newContent: '' } as {newContent: string; previousShortcode?: IShortcodeSearchResult<ITag>} );
	const tail = content.slice( results.previousShortcode ? results.previousShortcode.end : 0 );
	return results.newContent + tail;
};
