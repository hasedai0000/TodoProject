/**
 * TodoListTemplate
 *
 * @package components
 */

import { BaseLayout } from '@/components/organisms/BaseLayout';
import styles from './styles.module.css';

export const TodoListTemplate = () => {
  return (
    <BaseLayout title={'TodoList'}>
      <div className={styles.container}>
        {/* Todo検索フォームエリア */}
        <div className={styles.area}></div>
        {/* Todoリスト一覧表示 */}
        <div className={styles.area}></div>
      </div>
    </BaseLayout>
  );
};
